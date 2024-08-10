<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubjectsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default' => 'active',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('subjects');
    }

    public function down()
    {
        $this->forge->dropTable('subjects');
    }
}
