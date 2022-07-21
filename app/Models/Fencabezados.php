<?php

namespace App\Models;

use CodeIgniter\Model;

class Fencabezados extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'fencabezado';
    protected $primaryKey       = 'id_fencabezado';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_cliente', 'id_user', 'fecha', 'iva', 'subtotal', 'total', 'estado', 'numerofactura'];

    public function __construct()
    {
        parent::__construct();
    }

    public function selectFencabezadoPoductosForId($id)
    {

        $builder = $this->db->table('fencabezado');
        $builder->select('fdetalle.estado,productos.codigo,productos.producto,productos.preciopublico,productos.preciomayorista,productos.id_producto,fdetalle.cantidad,productos.cantidad as stock');
        $builder->join('fdetalle', 'fdetalle.id_fencabezado = fencabezado.id_fencabezado');
        $builder->join('productos', 'productos.id_producto = fdetalle.id_producto');
        $builder->where('fencabezado.id_fencabezado', $id);
        $builder->where('fencabezado.estado', 1);
        $builder->where('fdetalle.eliminar', 1);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function selectFencabezadoPoductosForIdReporte($id)
    {

        $builder = $this->db->table('fencabezado');
        $builder->select('fdetalle.estado,productos.codigo,productos.producto,productos.preciopublico,productos.preciomayorista,productos.id_producto,fdetalle.cantidad,productos.cantidad as stock');
        $builder->join('fdetalle', 'fdetalle.id_fencabezado = fencabezado.id_fencabezado');
        $builder->join('productos', 'productos.id_producto = fdetalle.id_producto');
        $builder->where('fencabezado.id_fencabezado', $id);
        $builder->where('fencabezado.estado', 2);
        $builder->where('fdetalle.eliminar', 1);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function selectFencabezadoForId($id)
    {

        $builder = $this->db->table('fencabezado');
        $builder->select('*');
        $builder->where('fencabezado.id_fencabezado', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }


    public function selectFencabezado()
    {
        $builder = $this->db->table('fencabezado');
        $builder->select('COUNT(fencabezado.estado) as contador');
        $builder->where('fencabezado.estado', 2);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function selectFencabezadoTotalDia($dia)
    {
        $builder = $this->db->table('fencabezado');
        $builder->select('SUM(fencabezado.total) as total');
        $builder->where('fencabezado.estado', 2);
        $builder->where('DAY(fencabezado.created_at) ', $dia);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function selectFencabezadoTotalMes($mes)
    {
        $builder = $this->db->table('fencabezado');
        $builder->select('SUM(fencabezado.total) as total');
        $builder->where('fencabezado.estado', 2);
        $builder->where('MONTH(fencabezado.created_at) ', $mes);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function selectFencabezadoTotalAnio($anio)
    {
        $builder = $this->db->table('fencabezado');
        $builder->select('SUM(fencabezado.total) as total');
        $builder->where('fencabezado.estado', 2);
        $builder->where('YEAR(fencabezado.created_at) ', $anio);
        $query = $builder->get();
        return $query->getResultArray();
    }



    public function selectFencabezadoRealizada()
    {

        $builder = $this->db->table('fencabezado');
        $builder->select('fencabezado.created_at,fencabezado.id_fencabezado,fencabezado.numerofactura,fencabezado.subtotal,fencabezado.iva,fencabezado.total,clientes.nombre as cnombre,clientes.apellido as capellido');
        $builder->join('clientes', 'clientes.id_cliente = fencabezado.id_cliente');
        $builder->orderBy('DAY(fencabezado.created_at)', 'DESC');
        $builder->where('fencabezado.estado', 2);
        $query = $builder->get();

        return $query->getResultArray();
    }


    public function sumMonthFencabezado($anio)
    {
        $builder = $this->db->table('fencabezado');
        $builder->select(' SUM(fencabezado.total) AS TOTAL, MONTH(fencabezado.created_at) AS mes');
        $builder->where(' YEAR(fencabezado.created_at) ', $anio);
        $builder->orderBy('MONTH(fencabezado.created_at)', 'ASC');
        $builder->groupBy('MONTH(fencabezado.created_at)');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function selectClienteForIdFecabezado()
    {

      
        $builder = $this->db->table('fencabezado');
        $builder->select('*');
        $builder->join('clientes', 'clientes.id_cliente = fencabezado.id_cliente');
        $builder->where('fencabezado.estado', 1);
        
        $query = $builder->get();

        return $query->getResultArray();
    }
}
