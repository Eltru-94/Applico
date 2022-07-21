<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Clientes;
use App\Models\Fencabezados;
use App\Models\Productos;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Fencabezado extends BaseController
{
    public function index()
    {
        //
    }

    public function anular($id)
    {
        $data = [
            'estado' => 0
        ];
        $modelFencabezado = new Fencabezados();
        $query = $modelFencabezado->update($id, $data);
        if ($query) {
            return $this->getRespose([
                'success' => 'Anulada'
            ]);
        }
    }

    public function impresionFactura($id)
    {
        print_r("listoaaaa" . $id);
        $modelFencabezado = new Fencabezados();
        $modelCliente = new Clientes();
        $query = $modelFencabezado->selectFencabezadoPoductosForIdReporte($id);
        $query_encabezado = $modelFencabezado->selectFencabezadoForId($id);
        $query_cliente = $modelCliente->selectForId($query_encabezado[0]['id_cliente']);

        $datos = [
            'fdetalles' => $query,
            'fencabezado' => $query_encabezado,
            'cliente' => $query_cliente,
            'title' => $query_encabezado[0]['numerofactura']
        ];

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('caja/factura', $datos));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("archivo" . $query_encabezado[0]['numerofactura'] . "_.pdf", array("Attachment" => 1));
    }


    public function procesar($id)
    {

        $modelFencabezado = new Fencabezados();
        $query = $modelFencabezado->selectFencabezadoPoductosForId($id);
        $count = $modelFencabezado->selectFencabezado();
        $numerofactura = "00000" . ($count[0]['contador'] + 1);


        if (count($query) > 0) {

            $suma = 0;
            foreach ($query as $datos) {
                
                $id_producto = $datos['id_producto'];
                $stock = $datos['stock'];
                $id_precio = $datos['estado'];
                $cantidad = $datos['cantidad'];
                $totalproductos = $stock - $cantidad;
                $newdate = [
                    'cantidad' => $totalproductos
                ];
                $precio = 0;
                if ($id_precio == 1) {
                    $precio = $datos['preciopublico'];
                }

                if ($id_precio == 2) {
                    $precio = $datos['preciomayorista'];
                }
                $modelProductos = new Productos();
                $modelProductos->update($id_producto, $newdate);
                $suma = $suma + ($precio * $cantidad);
            }
            $iva = ($suma * 0.12);
            $subtotal = ($suma - $iva);
            $total = $suma;
            $datos = [
                'iva' => $iva,
                'subtotal' => $subtotal,
                'total' => $total,
                'estado' => 2,
                'numerofactura' => $numerofactura
            ];

            $modelFencabezado->update($id, $datos);



            return $this->getRespose([
                'fencabezado' => $id,
                'success' => "Procesado...!!!"
            ]);
        }
    }

    public function selectFencabezadoRealizada()
    {
        $modelFencabezado = new Fencabezados();
        $query = $modelFencabezado->selectFencabezadoRealizada();

        return $this->getRespose([
            'fencabezado' => $query
        ]);
    }

    public function selectFencabezadoRealizadaExel()
    {
        $modelFencabezado = new Fencabezados();
        $query = $modelFencabezado->selectFencabezadoRealizada();

        $fileName = 'ventas.xlsx';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'USUARIO');
        $sheet->setCellValue('B1', 'CLIENTE');
        $sheet->setCellValue('C1', 'N.- FACTURA');
        $sheet->setCellValue('D1', 'SUB TOTAL');
        $sheet->setCellValue('E1', 'IVA');
        $sheet->setCellValue('F1', 'TOTAL');
        $sheet->setCellValue('G1', 'CREADO');
        $count = 2;
        foreach ($query as $row) {
            $usuario = $row['unombre'] . '' . $row['uapellido'];
            $cliente = $row['cnombre'] . '' . $row['capellido'];

            $sheet->setCellValue('A' . $count, $usuario);
            $sheet->setCellValue('B' . $count, $cliente);
            $sheet->setCellValue('C' . $count, $row['numerofactura']);
            $sheet->setCellValue('D' . $count, $row['subtotal']);
            $sheet->setCellValue('E' . $count, $row['iva']);
            $sheet->setCellValue('F' . $count, $row['total']);
            $sheet->setCellValue('G' . $count, $row['created_at']);

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



    public function totalRealizadas()
    {
        $dia = date('d');
        $mes = date('m');
        $anio = date('y');
        $modelFencabezado = new Fencabezados();
        $querydia = $modelFencabezado->selectFencabezadoTotalDia($dia);
        $querymes = $modelFencabezado->selectFencabezadoTotalMes($mes);
        $queryanio = $modelFencabezado->selectFencabezadoTotalAnio("20" . $anio);
        return $this->getRespose([
            'total_dia' => $querydia,
            'total_mes' => $querymes,
            'total_anio' => $queryanio
        ]);
    }

    public function totalRealizadasMes()
    {

        $anio = date('y');
        $modelFencabezado = new Fencabezados();
        $query = $modelFencabezado->sumMonthFencabezado("20" . $anio);

        return $this->getRespose([
            'total_mes' => $query
        ]);
    }

    public function selectClienteForIdFencabezado()
    {
        $modelFencabezado = new Fencabezados();
        $query = $modelFencabezado->selectClienteForIdFecabezado();
        return $this->getRespose([
            'cliente' => $query
        ]);
    }
}
