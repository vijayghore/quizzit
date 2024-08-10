<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmailLog extends Migration
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
            'recipient' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'subject' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'message' => [
                'type' => 'TEXT',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'error_message' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('email_logs');
    }

    public function down()
    {
        $this->forge->dropTable('email_logs');
    }
}
