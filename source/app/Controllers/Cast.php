<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Cast extends BaseController
{
    public function index()
    {
        // 実際のキャスト一覧取得用API（例）
        $apiUrl = "https://api.example.com/v1/casts?shop_id=2407";
        
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->get($apiUrl);
            $castData = json_decode($response->getBody(), true);
            $casts = $castData['data'] ?? [];
        } catch (\Exception $e) {
            $casts = [];
        }

        return view('front/cast_index', [
            'page_title' => 'キャスト一覧',
            'casts'      => $casts
        ]);
    }
}
