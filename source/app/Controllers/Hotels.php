<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HotelModel;

class Hotels extends BaseController
{
    public function index()
    {
        $hotelModel = new HotelModel();
        
        // 公開中のホテルだけを、ピックアップ優先 ＆ 並び順 で取得
        $data['hotels'] = $hotelModel->where('is_available', 1)
                                     ->orderBy('is_pickup', 'DESC')
                                     ->orderBy('sort_order', 'ASC')
                                     ->findAll();
                                     
        return view('front/hotels', $data);
    }
}