<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Reporte extends BaseController
{
    public function index()
    {
        $datos=[
            'title'=>'Reporte Usuarios',
        ];
        return view('administrador/index',$datos);

        
    }

    public function clientes()
    {
        $datos=[
            'title'=>'Reporte Clientes',
        ];
        return view('reportes/clientes/index',$datos);

    }
    public function ventas()
    {
        $datos=[
            'title'=>'Reporte Ventas',
        ];
        return view('reportes/ventas/index',$datos);


    }
    public function productos()
    {
        $datos=[
            'title'=>'Reporte productos',
        ];
        return view('reportes/productos/index',$datos);


    }
}
