<?php

namespace App\Models;

use CodeIgniter\Model;

class Categorias extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'categorias';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['categoria', 'estado'];

    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    public function selectCategorias()
    {
        $builder = $this->db->table('categorias');
        $query = $builder->get();
        return $query->getResultArray();
    }

    
    public function selectCategoriasApi()
    {
        $builder = $this->db->table('categorias');
        $builder->where('estado',1);
        $query = $builder->get();
        return $query->getResultArray();
    }


    public function selectCategoriaId($id_categoria)
    {
        $builder = $this->db->table('categorias');
        $builder->where('id_categoria', $id_categoria);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function selectCategoriaEstado1($estado)
    {
        $builder = $this->db->table('categorias');
        $builder->where('estado', $estado);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function updateCategoria($data, $id_categoria)
    {

        $builder = $this->db->table('categorias');
        $builder->where('id_categoria', $id_categoria);
        $query = $builder->update($data);
        return $query;
    }
}
