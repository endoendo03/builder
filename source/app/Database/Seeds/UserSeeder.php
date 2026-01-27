<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $model = model('UserModel');

        for ($i = 1; $i <= 10; $i++) {
            $model->insert([
                'username' => "user{$i}",
                'email'    => "user{$i}@example.com",
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'birthday' => '1990-01-' . sprintf('%02d', $i),
                'phone'    => "090-0000-00" . sprintf('%02d', $i),
            ]);
        }
    }
}