<?php

namespace App\Models;

use CodeIgniter\Model;

class Fdetalles extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'fdetalle';
    protected $primaryKey       = 'id_fdetalle';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_fencabezado','cantidad','id_producto','estado','eliminar'];

    public function __construct()
    {
        parent::__construct();
       
    }


    public function selectDatosFactura($id_fencabezado){
        $builder = $this->db->table('fdetalle');
        $builder->select('productos.codigo,productos.producto,fdetalle.cantidad,fdetalle.estado,id_fdetalle,productos.id_producto');
        $builder->join('productos', 'productos.id_producto = fdetalle.id_producto');
        $builder->where('fdetalle.eliminar',1);
        $builder->where('fdetalle.id_fencabezado',$id_fencabezado);
        $query = $builder->get();

        return $query->getResultArray();
    }


    public function selectIdFacturaEncabezado($id_user){
        $builder = $this->db->table('fencabezado');
        $builder->select('id_fencabezado');
        $builder->where('id_user',$id_user);
        $builder->where('estado',1);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function selectFDetalleForId($id_fdetalle){
        $builder = $this->db->table('fdetalle');
        $builder->select('*');
        $builder->where('id_fdetalle',$id_fdetalle);
        $query = $builder->get();

        return $query->getResultArray();
    }


}
