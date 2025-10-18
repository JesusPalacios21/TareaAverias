<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearTablaAverias extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'cliente' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'problema' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
            'fechahora' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pendiente', 'solucionado'],
                'default'    => 'pendiente',
            ],
        ]);
        $this->forge->addKey('id', true); // clave primaria
        $this->forge->createTable('averias');
    }

    public function down()
    {
        $this->forge->dropTable('averias');
    }
}
