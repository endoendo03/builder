<?php

namespace App\Models;

use CodeIgniter\Model;

class TransportFeeModel extends Model
{
    // テーブル名
    protected $table = 'transport_fees';
    
    // 主キー
    protected $primaryKey = 'id';
    
    // オートインクリメント
    protected $useAutoIncrement = true;
    
    // 戻り値の型（配列として扱う）
    protected $returnType = 'array';
    
    // 論理削除（deleted_atを使う場合）
    protected $useSoftDeletes = true;
    
    // 保存（INSERT/UPDATE）を許可するカラム
    protected $allowedFields = [
        'ward', 
        'syllabary', 
        'town_name', 
        'fee'
    ];
    
    // タイムスタンプ（created_at, updated_at, deleted_at を自動管理）
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}