<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run()
    {
        $model = model('CouponModel');

        for ($i = 1; $i <= 10; $i++) {
            $model->insert([
                'name'        => "冬の特別キャンペーン第{$i}弾",
                'code'        => "WINTER" . sprintf('%03d', $i),
                'discount'    => 500 * $i, // 500円ずつ増えるテストデータ
                'expire_date' => date('Y-12-31'), // 今年末まで
            ]);
        }
    }
}