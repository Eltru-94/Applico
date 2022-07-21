<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Productos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_producto' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true
            ],
            'codigo' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'producto' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'precioreal' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'preciopublico' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'preciomayorista' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'telefonoproveedor' => [
                'type' => 'INT',
                'constraint' => 10
            ],
            'id_categoria' => [
                'type' => 'INT',
                'constraint' => 10
            ],
            'estado' => [
                'type' => 'INT',
                'constraint' => 2
            ],
            'cantidad' => [
                'type' => 'INT',
                'constraint' => 2
            ],

            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addForeignKey('id_categoria', 'categorias', 'id_categoria');
        $this->forge->addKey('id_producto', TRUE);
        $this->forge->createTable('productos');
    }

    public function down()
    {
        $this->forge->dropTable('productos');
    }
}
