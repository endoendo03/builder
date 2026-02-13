<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Schedule extends BaseController
{
    public function index()
    {
        $date = $_GET['date'] ?? date('Y-m-d');
        $client = \Config\Services::curlrequest();
        $url = 'https://api.purelovers.com/site_builder/';

        try {
            
            $response = $client->get($url, [
                'query' => [
                    'mode' => 'shop_girl_schedule',
                    'shop_id' => PURELOVERS_SHOP_ID,
                    // 'date' => $date
                ]
            ]);
            $castData = json_decode($response->getBody(), true);
            $casts = $castData['data'] ?? [];
        } catch (\Exception $e) {
            $casts = [];
        }

        return view('front/schedule_index', [
            'page_title' => '出勤一覧',
            'casts'      => $casts
        ]);
    }
}
