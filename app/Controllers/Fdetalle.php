<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Fdetalles;
use App\Models\Productos;

class Fdetalle extends BaseController
{
    public function index()
    {
        //
    }

    public function store()
    {
        $input = $this->getRequestInput($this->request);

        if (!$input['stock']) {
            return  $this->getRespose([
                'error' => [
                    'stock' => 'Campo stock requerido'
                ]
            ]);
        }
        if (!$input['estado']) {
            return  $this->getRespose([
                'error' => [
                    'precio' => 'Selecione un precio'
                ]
            ]);
        }

        if ($input['cantidad'] > $input['stock']) {
            return  $this->getRespose([
                'error' => [
                    'stock' => 'Stock insuficiente'
                ]
            ]);
        }
        $modelFdetalles = new Fdetalles();
        $input['eliminar'] = 1;
        unset($input['stock']);
        $modelFdetalles->insert($input);
        return  $this->getRespose([
            'success' => "Añadido"
        ]);
    }



    public function selectFacturaDetalle($id)
    {
        $modelFDetalle = new Fdetalles();
        $modelProducto = new Productos();
        $query = $modelFDetalle->selectDatosFactura($id);
        $contador = 0;
        foreach ($query as $datos) {
            $op = $datos['estado'];
            $query1 = $modelProducto->selectId($datos['id_producto']);
            $precio = "";
            switch ($op) {
                case 1:
                    $precio = $query1[0]['preciopublico'];
                    break;
                case 2:
                    $precio = $query1[0]['preciomayorista'];
                    break;
                case 3:
                    break;
            }
            array_push($query[$contador], $precio);
            $contador++;
        }

        return $this->getRespose([
            'facturaDetalle' => $query
        ]);
    }



    public function selectEncabezadoID($id)
    {
        $modelFDetalle = new Fdetalles();
        $query = $modelFDetalle->selectIdFacturaEncabezado($id);
        return $this->getRespose([
            'id_fencabezado' => $query[0]['id_fencabezado']
        ]);
    }

    public function deleteProducto($id)
    {

        $input = [
            'eliminar' => 0
        ];
        $modelFDetalle = new Fdetalles();
        $modelFDetalle->update($id, $input);
        return $this->getRespose([
            'success' => 'Eliminado'
        ]);
    }

    public function updateCantidadProducto()
    {

        $input = $this->getRequestInput($this->request);
        $modelFDetalle = new Fdetalles();
        $modelProducto = new Productos();
        $id_producto = $input['id_producto_update'];
        $id_fdetalle=$input['id_fdetalle_update'];
        $query = $modelProducto->selectId($id_producto);
        $cantidad = $input['cantidad_update'];
        $stock = $query[0]['cantidad'];

        if ($stock < $cantidad) {

            $error = [
                'cantidad' => 'stock insuficiente'
            ];

            return $this->getRespose([
                'error' => $error,
            ]);
        }
        unset($input['id_producto_update']);
        unset($input['id_fdetalle_update']);
        unset($input['cantidad_update']);
        $input['cantidad']=$cantidad;
        $modelFDetalle->update($id_fdetalle, $input);
        return $this->getRespose([
            'success' =>"Actualizado",
            'id_fdetalle'=>$id_fdetalle,
            'cantidad'=>$cantidad,
            'id_producto'=>$id_producto
        ]);
    }

    public function selectFdetalleForId($id){
        $modelFdetalle=new Fdetalles();
        $query=$modelFdetalle->selectFdetalleForId($id);
        return $this->getRespose([
            'fdetalle'=>$query
        ]);
    }
}
