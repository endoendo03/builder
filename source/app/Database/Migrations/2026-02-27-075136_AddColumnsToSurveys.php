<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnsToSurveys extends Migration
{
    public function up()
    {
        $fields = [
            'description' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'title', // titleカラムの後ろに追加
            ],
            'sort_order' => [
                'type'       => 'INTEGER',
                'default'    => 0,
                'after'      => 'status',
            ],
        ];
        $this->forge->addColumn('surveys', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('surveys', ['description', 'sort_order']);
    }
}
