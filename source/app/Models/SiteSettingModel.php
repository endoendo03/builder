<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteSettingModel extends Model
{
    protected $table      = 'site_settings';
    protected $primaryKey = 'id';
    
    // 保存を許可するカラム
    protected $allowedFields = [
        'header_tags', 
        'footer_tags'
    ];
    
    // タイムスタンプ（updated_atだけ自動更新させる）
    protected $useTimestamps = true;
    protected $createdField  = ''; // 今回は使わない
    protected $updatedField  = 'updated_at';
}