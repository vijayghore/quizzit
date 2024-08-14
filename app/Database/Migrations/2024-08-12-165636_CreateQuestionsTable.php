<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'subject_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'description' => [
                'type' => 'TEXT'
            ],
            'option_1' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'option_2' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'option_3' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'option_4' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'correct_answer' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'created_by' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['inactive', 'active'],
                'default' => 'inactive'
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('subject_id', 'subjects', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('questions');
    }

    public function down()
    {
        $this->forge->dropTable('questions');
    }
}
