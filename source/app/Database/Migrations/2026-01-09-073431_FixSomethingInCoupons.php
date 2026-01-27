<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixSomethingInCoupons extends Migration
{
    public function up()
    {
        $fields = [
            'discount_type' => [
                'type'       => 'ENUM',
                'constraint' => ['fixed', 'percent'],
                'default'    => 'fixed',
                'after'      => 'name'
            ],
            'status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1, // 1:有効, 0:無効
                'after'      => 'expire_date'
            ],
        ];
        $this->forge->addColumn('coupons', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('coupons', ['discount_type', 'status']);
    }
}
