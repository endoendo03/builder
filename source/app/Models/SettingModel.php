<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'shop_settings';
    protected $primaryKey = 'key';
    protected $allowedFields = ['key', 'value'];

    // 全設定を ['key' => 'value'] の形式で取得する便利なメソッド
    public function getKeyValuePairs()
    {
        $settings = $this->findAll();
        return array_column($settings, 'value', 'key');
    }
}