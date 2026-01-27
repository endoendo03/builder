<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAdminFieldsToUsers extends Migration
{
    public function up()
    {
        $fields = [
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'suspended', 'banned'],
                'default'    => 'active',
                'after'      => 'phone'
            ],
            'rank' => [
                'type'       => 'ENUM',
                'constraint' => ['regular', 'silver', 'gold'],
                'default'    => 'regular',
                'after'      => 'status'
            ],
            'admin_memo' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'rank'
            ],
        ];
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['status', 'rank', 'admin_memo']);
    }
}
