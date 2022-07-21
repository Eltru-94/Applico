<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Administrador extends BaseController
{
    public function index()
    {

        $datos=[
            'title'=>"Vendedor",
        ];
        return view('administrador/index',$datos);

    }
}
