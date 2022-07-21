<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clientes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_cliente' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => True
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint'  => 50
            ],
            'apellido' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'cedula' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'telefono' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'estado' => [
                'type' => 'VARCHAR',
                'constraint' => 2
            ],
            'direccion' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'created_at datetime default current_timestamp'
        ]);
        $this->forge->addKey('id_cliente', true);
        $this->forge->createTable('clientes');
    }

    public function down()
    {
        $this->forge->dropTable('clientes');
    }
}
