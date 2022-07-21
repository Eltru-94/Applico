<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;
use \App\Validation\CustomRules;



class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */


    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        CustomRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];





    public $categoria = [
        'categoria' => 'required|is_unique[categorias.categoria]'
    ];

    public $producto = [
        'codigo' => 'required',
        'producto' => 'required',
        'precioreal' => 'required',
        'preciopublico' => 'required',
        'preciomayorista' => 'required',
        'cantidad' => 'required',
    ];

    public $productoUpdate = [
        'producto' => 'required',
        'precioreal' => 'required|decimal',
        'preciopublico' => 'required|decimal',
        'preciomayorista' => 'required|decimal',
        'cantidad' => 'required|is_natural'
    ];

    public $cliente=[
        'nombre'=>'required',
        'apellido'=>'required',
        'cedula'=>'required|is_natural|min_length[10]|max_length[10]',
        'telefono'=>'required|is_natural|min_length[10]|max_length[10]',
        'direccion'=>'required'
    ];

    public $cedulacliente=[
        'cedula'=>'required|is_natural|min_length[10]|max_length[10]',
    ];






    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
}
