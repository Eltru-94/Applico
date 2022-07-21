<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EncabezadoFactura extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_fencabezado' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => True
            ],
            'id_cliente' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'fecha' => [
                'type' => 'DATETIME',
            ],
            'iva' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
                'null' => true
            ],
            'subtotal' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
                'null' => true
            ],
            'total' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
                'null' => true
            ],
            'numerofactura' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
                'null' => true
            ],
            'estado' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'created_at datetime default current_timestamp'
        ]);
        $this->forge->addForeignKey('id_cliente', 'clientes', 'id_cliente');
        $this->forge->addKey('id_fencabezado', true);
        $this->forge->createTable('fencabezado');
    }

    public function down()
    {
        $this->forge->dropTable('fencabezado');
    }
}
