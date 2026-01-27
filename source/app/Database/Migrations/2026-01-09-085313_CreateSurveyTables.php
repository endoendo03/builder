<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSurveyTables extends Migration
{
    public function up()
    {
        // 1. アンケート本体
        $this->forge->addField([
            'id'          => ['type' => 'INTEGER', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'title'       => ['type' => 'VARCHAR', 'constraint' => '255'],
            'description' => ['type' => 'TEXT', 'null' => true],
            'status'      => ['type' => 'ENUM', 'constraint' => ['open', 'closed'], 'default' => 'open'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('surveys');

        // 2. 設問（1つのアンケートに複数の設問）
        $this->forge->addField([
            'id'          => ['type' => 'INTEGER', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'survey_id'   => ['type' => 'INTEGER', 'constraint' => 5, 'unsigned' => true],
            'question'    => ['type' => 'VARCHAR', 'constraint' => '255'],
            'type'        => ['type' => 'ENUM', 'constraint' => ['text', 'number', 'radio'], 'default' => 'text'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('survey_questions');

        // 3. 回答
        $this->forge->addField([
            'id'          => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'survey_id'   => ['type' => 'INTEGER', 'constraint' => 5, 'unsigned' => true],
            'user_id'     => ['type' => 'INTEGER', 'constraint' => 5, 'unsigned' => true, 'null' => true],
            'answers_json'=> ['type' => 'TEXT'], // 全回答をJSONでガサッと保存すると楽です
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('survey_responses');
    }

    public function down()
    {
        $this->forge->dropTable('survey_responses');
        $this->forge->dropTable('survey_questions');
        $this->forge->dropTable('surveys');
    }
}
