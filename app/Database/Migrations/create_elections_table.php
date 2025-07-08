<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateElectionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'start_date' => [
                'type' => 'DATETIME'
            ],
            'end_date' => [
                'type' => 'DATETIME'
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'active', 'completed'],
                'default' => 'pending'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('elections');
    }

    public function down()
    {
        $this->forge->dropTable('elections');
    }
}
