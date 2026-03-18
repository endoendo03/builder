<?php
namespace App\Models;
use CodeIgniter\Model;

class HotelModel extends Model {
    protected $table = 'hotels';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'address', 'tel', 'transport_fee', 
        'is_available', 'note', 'is_pickup', 'sort_order'
    ];
    protected $useTimestamps = true;
}