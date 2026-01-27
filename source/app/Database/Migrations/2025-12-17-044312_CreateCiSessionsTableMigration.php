<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCiSessionsTableMigration extends Migration
{
    protected $DBGroup = 'default';

    public function up()
    {
        // users テーブルの定義
        $this->forge->addField([
            'id'          => ['type' => 'INTEGER', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'username'    => ['type' => 'VARCHAR', 'constraint' => '100', 'unique' => true],
            'email'       => ['type' => 'VARCHAR', 'constraint' => '100', 'unique' => true],
            'password'    => ['type' => 'VARCHAR', 'constraint' => '255'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true); // プライマリキー設定
        $this->forge->createTable('users');
        
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 128, 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('timestamp');
        $this->forge->createTable('ci_sessions', true);
    }

    public function down()
    {
        $this->forge->dropTable('ci_sessions', true);
    }
}
