<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categorias extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_categoria' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true
            ],
            'categoria' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'estado' => [
                'type' => 'INT',
                'constraint' => 2
            ],

            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey('id_categoria', TRUE);
        $this->forge->createTable('categorias');
    }

    public function down()
    {
        $this->forge->dropTable('categorias');
    }
}
