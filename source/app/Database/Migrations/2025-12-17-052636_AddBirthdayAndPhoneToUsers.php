<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBirthdayAndPhoneToUsers extends Migration
{
    public function up()
    {
        $fields = [
            'birthday' => ['type' => 'DATE', 'null' => true, 'after' => 'email'],
            'phone'    => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => true, 'after' => 'birthday'],
        ];
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['birthday', 'phone']);
    }
}
