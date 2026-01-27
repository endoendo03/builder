<?php 
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true; // deleted_at を利用
    protected $order = ['id' => 'desc'];

    protected $allowedFields = [
    'username', 'email', 'password', 'birthday', 'phone', 
    'status', 'rank', 'admin_memo' // ★追加
];

    // タイムスタンプ
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}