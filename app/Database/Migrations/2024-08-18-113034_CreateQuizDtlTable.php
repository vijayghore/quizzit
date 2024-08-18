<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuizDtlTable extends Migration
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
            'quiz_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'question_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['inactive', 'active'],
                'default' => 'inactive'
            ],
        ]);

        $this->forge->addKey('id', true);

        // Add foreign key constraints
        $this->forge->addForeignKey('quiz_id', 'quiz', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('question_id', 'questions', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('quiz_dtl');
    }

    public function down()
    {
        $this->forge->dropTable('quiz_dtl');
    }
}
