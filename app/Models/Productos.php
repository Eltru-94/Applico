<?php

namespace App\Models;

use CodeIgniter\Model;

class Productos extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'productos';
    protected $primaryKey       = 'id_producto';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['codigo', 'producto', 'precioreal', 'preciopublico', 'preciomayorista', 'telefonoproveedor', 'id_categoria', 'estado', 'cantidad'];

    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    public function selectProductosCategoria($id_categoria)
    {
        $builder = $this->db->table('productos');
        $builder->select('*');
        $builder->where('id_categoria', $id_categoria);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function selectProductos()
    {
        $builder = $this->db->table('productos');
        $builder->select('productos.id_producto,productos.codigo,productos.cantidad,productos.producto,productos.precioreal,productos.preciopublico,productos.preciomayorista,productos.telefonoproveedor,productos.id_categoria,productos.estado,categorias.categoria');
        $builder->join('categorias', 'categorias.id_categoria = productos.id_categoria');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function updateProducto($data, $id_producto)
    {

        $builder = $this->db->table('productos');
        $builder->where('id_producto', $id_producto);
        $query = $builder->update($data);
        return $query;
    }

    public function selectId($id)
    {
        $builder = $this->db->table('productos');
        $builder->select('*');
        $builder->where('id_producto', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function productosActivos()
    {
        $builder = $this->db->table('productos');
        $builder->select('id_producto,producto,codigo');
        $builder->where('estado', 1);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
