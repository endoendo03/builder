<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class System extends BaseController
{
    public function index()
    {
        // 今回のAPI URL
        $apiUrl = "https://api.purelovers.com/site_builder/?mode=shop_system_charge&shop_id=2407";
        
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->get($apiUrl);
            $systemData = json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            $systemData = [];
        }

        return view('front/system_index', [
            'page_title' => '料金システム',
            'system'     => $systemData
        ]);
    }
}
