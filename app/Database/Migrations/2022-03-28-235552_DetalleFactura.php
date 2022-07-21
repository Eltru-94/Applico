<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetalleFactura extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_fdetalle' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => True
            ],
            'id_fencabezado' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'cantidad' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'id_producto' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'estado' => [
                'type' => 'INT',
                'constraint' => 2
            ],
            'eliminar' => [
                'type' => 'INT',
                'constraint' => 2
            ],
            'created_at datetime default current_timestamp'
        ]);
        $this->forge->addForeignKey('id_fencabezado', 'fencabezado', 'id_fencabezado');
        $this->forge->addForeignKey('id_producto', 'productos', 'id_producto');
        $this->forge->addKey('id_fdetalle', true);
        $this->forge->createTable('fdetalle');
    }

    public function down()
    {
        $this->forge->dropTable('fdetalle');
    }
}
