<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Cast extends BaseController
{
    public function index()
    {
        $client = \Config\Services::curlrequest();
        $url = 'https://api.purelovers.com/site_builder/';

        try {
            
            $response = $client->get($url, [
                'query' => [
                    'mode' => 'shop_girl_all',
                    'shop_id' => PURELOVERS_SHOP_ID
                ]
            ]);
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
