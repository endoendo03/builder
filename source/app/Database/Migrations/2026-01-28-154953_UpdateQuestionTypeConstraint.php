<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateQuestionTypeConstraint extends Migration
{
    public function up()
    {
        // SQLiteは MODIFY COLUMN が苦手なので、一度制約を緩めた定義で上書きを試みます
        // ※環境によってはテーブルの再作成が必要ですが、まずは型定義の変更を試します
        $fields = [
            'type' => [
                'type'    => 'TEXT',
                'default' => 'text',
                // ここでCHECK制約を書かない、もしくは全種類網羅する
            ],
        ];
        $this->forge->modifyColumn('questions', $fields);
    }
}
