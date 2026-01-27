<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run() {
    $model = model('AdminModel');
    $model->insert([
        'username' => 'admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT), // ログインパスワード
    ]);
}
}
