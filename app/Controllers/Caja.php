<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Caja extends BaseController
{
    public function index()
    {
        $datos=[
            'title'=>'Caja',
        ];
        return view('caja/index',$datos);

    }
}
