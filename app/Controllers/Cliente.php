<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Clientes;
use App\Models\Fencabezados;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Cliente extends BaseController
{
    public function index()
    {
        //
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        if (!$this->validate('cliente')) {

            return $this->getRespose([
                'error' => $validation->getErrors()
            ]);
        }

        $input = $this->getRequestInput($this->request);
        $input['estado'] = 1;
        $fencabezado = [
            'id_cliente' => $input['id_cliente'],
            'id_user' => 1,
            'fecha' => date('Y-m-d H:i:s'),
            'estado' => 1
        ];
        $id_cliente = $input['id_cliente'];
        $modelCliente = new Clientes();
        $modelFencabezado = new Fencabezados();
        $query = $modelCliente->selectForId($id_cliente);
        unset($input['id_cliente']);

        if (count($query) == 1) {


            unset($input['cedula']);
            unset($input['estado']);
            $modelCliente->update($id_cliente, $input);
            $aux = $modelFencabezado->insert($fencabezado);
            return $this->getRespose([
                'success' => "Actualizado",
                'id_fencabezado' => $aux
            ]);
        }

        $fencabezado['id_cliente'] = $modelCliente->insert($input);
        $aux = $modelFencabezado->insert($fencabezado);

        return $this->getRespose([
            'success' => "Registrado",
            'id_fencabezado' => $aux
        ]);
    }


    public function selectForCI()
    {

        $validation = \Config\Services::validation();
        if (!$this->validate('cedulacliente')) {

            return $this->getRespose([
                'error' => $validation->getErrors()
            ]);
        }

        $input = $this->getRequestInput($this->request);

        $modelCliente = new Clientes();

        $query = $modelCliente->selectForCI($input['cedula']);

        if (count($query) == 0) {

            return $this->getRespose([
                'cliente' => "Cliente no registrado",
                'mensaje' => "Cliente no registrado"
            ]);
        }

        return $this->getRespose([
            'cliente' => $query,
            'mensaje' => 'Cliente registrado'
        ]);
    }

    public function selectClientes()
    {
        $modelCliente = new Clientes();
        $query = $modelCliente->selectClientes();
        return $this->getRespose([
            'clientes' => $query
        ]);
    }



    public function selectClientesExel()
    {
        $modelCliente = new Clientes();
        $query = $modelCliente->selectClientes();
        $fileName = 'clientes.xlsx';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'NOMBRE');
        $sheet->setCellValue('B1', 'APELLIDO');
        $sheet->setCellValue('C1', 'CEDULA');
        $sheet->setCellValue('D1', 'TELEFONO');
        $sheet->setCellValue('E1', 'DIRECCION');
        $sheet->setCellValue('F1', 'REGISTRADO');
        $count = 2;

        foreach ($query as $row) {

            $sheet->setCellValue('A' . $count, $row['nombre']);
            $sheet->setCellValue('B' . $count, $row['apellido']);
            $sheet->setCellValue('C' . $count, $row['cedula']);
            $sheet->setCellValue('D' . $count, $row['telefono']);
            $sheet->setCellValue('E' . $count, $row['direccion']);
            $sheet->setCellValue('F' . $count, $row['created_at']);

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
    public function update($id)
    {
        //
    }
}
