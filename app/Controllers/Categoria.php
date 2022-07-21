<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Categorias;

class Categoria extends BaseController
{
    public function index()
    {
        $datos = [
            'title' => "Categorias",
        ];
        return view('productos/categoria/index', $datos);
    }

    public function selectCategorias()
    {
        $modelCategoria = new Categorias();
        $query = $modelCategoria->selectCategorias();
        return $this->getRespose([
            'categorias' => $query
        ]);
    }

    public function selectCategoriaId($id)
    {
        $modelCategoria = new Categorias();
        $query = $modelCategoria->selectCategoriaId($id);
        return $this->getRespose([
            'categorias' => $query
        ]);
    }

    /** Insert new categoria  */
    public function store()
    {


        $validation = \Config\Services::validation();
        if (!$this->validate('categoria')) {
            $errors = $validation->getErrors();
            return $this->getRespose([
                'error' => $errors,
            ]);
        }
        $input = $this->getRequestInput($this->request);
        $input['estado'] = 1;
        $modelCategoria = new Categorias();
        $modelCategoria->insert($input);

        return $this->getRespose([
            'success' => "Registrada",
        ]);
    }


    public function update()
    {
        $input = $this->getRequestInput($this->request);

        $validation = \Config\Services::validation();
        if (!$this->validate('categoria')) {
            $errors = $validation->getErrors();
            return $this->getRespose([
                'error' => $errors,
            ]);
        }
        $id_categoria = $input['id_categoria'];
        unset($input['id_categoria']);
        $modelCategoria = new Categorias();
        $modelCategoria->updateCategoria($input, $id_categoria);
        return $this->getRespose([
            'success' => "Actualizada",
        ]);
    }


    public function deleteCategoria()
    {

        $input = $this->getRequestInput($this->request);
        $id_categoria = $input['id_categoria'];
        $mensaje = "";
        if ($input['estado'] == 1) {
            $mensaje = "Activada";
        }
        if ($input['estado'] == 0) {
            $mensaje = "Inactivo";
        }
        unset($input['id_categoria']);
        $modelCategoria = new Categorias();
        $query = $modelCategoria->updateCategoria($input, $id_categoria);
        return $this->getRespose([
            'success' => $mensaje,
            'estado' => $input['estado']
        ]);
    }


    public function selectCategoriasEstado1()
    {
        $modelCategoria = new Categorias();
        $query = $modelCategoria->selectCategoriaEstado1(1);
        return $this->getRespose([
            'categorias' => $query
           
        ]);
    }
}
