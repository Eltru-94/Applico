<?php

namespace App\Models;

use CodeIgniter\Model;

class Clientes extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'clientes';
    protected $primaryKey       = 'id_cliente';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombre', 'apellido', 'cedula', 'direccion', 'estado', 'telefono'];

    public function __construct()
    {
        parent::__construct();
    }


    public function selectForCI($CI)
    {
        $builder = $this->db->table('clientes');
        $builder->select('*');
        $builder->where('cedula', $CI);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function selectForId($id_cliente)
    {
        $builder = $this->db->table('clientes');
        $builder->select('*');
        $builder->where('id_cliente', $id_cliente);
        $query = $builder->get();
        return $query->getResultArray();
    }



    public function selectClientes()
    {
        $builder = $this->db->table('clientes');
        $builder->select('*');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
