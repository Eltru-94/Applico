<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Categorias;
use App\Models\Productos;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Producto extends BaseController
{
    public function index()
    {
        $datos = [
            'title' => "Licores",
        ];
        return view('productos/index', $datos);
    }

    public function crearCodigoProducto($id_categoria)
    {
        $modelCategoria = new Categorias();
        $modelProductos = new Productos();
        $query1 = $modelProductos->selectProductosCategoria($id_categoria);
        $query = $modelCategoria->selectCategoriaId($id_categoria);
        $codigo = strtoupper(substr($query[0]['categoria'], 0, 5)) . ' - 0' . (count($query1) + 1);
        return $this->getRespose([
            'codigoProducto' => $codigo,
        ]);
    }

    public function select()
    {

       $modelProductos = new Productos();
        $query = $modelProductos->selectProductos();


        return $this->getRespose([
            'productos' => $query,
        ]);
    }

    public function selectExel()
    {

        $modelProductos = new Productos();
        $query = $modelProductos->selectProductos();


        $fileName = 'productos.xlsx';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'CODIGO');
        $sheet->setCellValue('B1', 'CATEGORIA');
        $sheet->setCellValue('C1', 'PRODUCTO');
        $sheet->setCellValue('D1', 'PRECIO REAL');
        $sheet->setCellValue('E1', 'PRECIO PUBLICO');
        $sheet->setCellValue('F1', 'PRECIO MAYORISTA');
        $sheet->setCellValue('G1', 'CANTIDAD');
        $sheet->setCellValue('H1', 'TELEFONO PROVEDOR');

        $count = 2;

        foreach ($query as $row) {
            $sheet->setCellValue('A' . $count, $row['codigo']);
            $sheet->setCellValue('B' . $count, $row['categoria']);
            $sheet->setCellValue('C' . $count, $row['producto']);
            $sheet->setCellValue('D' . $count, $row['precioreal']);
            $sheet->setCellValue('E' . $count, $row['preciopublico']);
            $sheet->setCellValue('F' . $count, $row['preciomayorista']);
            $sheet->setCellValue('G' . $count, $row['cantidad']);
            $sheet->setCellValue('H' . $count, $row['telefonoproveedor']);


            $count++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save($fileName);
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' . filesize($fileName));
        flush();

        readfile($fileName);
    }

    /** Insert new categoria  */
    public function store()
    {


        $validation = \Config\Services::validation();
        if (!$this->validate('producto')) {
            $errors = $validation->getErrors();
            return $this->getRespose([
                'error' => $errors,
            ]);
        }
        $input = $this->getRequestInput($this->request);
        $input['estado'] = 1;
        unset($input['id_producto']);
        $modelProductos = new Productos();
        $modelProductos->insert($input);

        return $this->getRespose([
            'success' => "Registrado",
            'a' => $input
        ]);
    }

    public function productoUpdate($id)
    {


        $modelProducto = new Productos();
        $query = $modelProducto->selectId($id);
        return $this->getRespose([
            'producto' => $query,
        ]);
    }



    public function deleteProducto()
    {

        $input = $this->getRequestInput($this->request);
        $id_producto = $input['id_producto'];
        $mensaje = "";
        if ($input['estado'] == 1) {
            $mensaje = "Activado";
        }
        if ($input['estado'] == 0) {
            $mensaje = "Inactivo";
        }
        unset($input['id_producto']);
        $modelProducto = new Productos();
        $query = $modelProducto->updateProducto($input, $id_producto);
        return $this->getRespose([
            'success' => $mensaje,
            'estado' => $input['estado']
        ]);
    }


    public function updateDatos()
    {
        $validation = \Config\Services::validation();
        if (!$this->validate('productoUpdate')) {
            $errors = $validation->getErrors();
            return $this->getRespose([
                'error' => $errors,
            ]);
        }
        /* recived date */
        $input = $this->getRequestInput($this->request);

        $modelproducto = new Productos();
        $id_producto = $input['id_producto'];
        $query = $modelproducto->selectId($id_producto);
        $input['cantidad'] = $query[0]['cantidad'] +  $input['cantidad'];
        unset($input['id_producto']);
        $modelproducto->update($id_producto, $input);
        return $this->getRespose([
            'success' => "Actualizado"

        ]);
    }

    public function productoActivos()
    {
        $modelProductos = new Productos();
        $query = $modelProductos->productosActivos();
        return $this->getRespose([
            'productos' => $query
        ]);
    }
}
