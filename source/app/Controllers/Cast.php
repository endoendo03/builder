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
    
    public function detail($id = null)
    {
        
        $client = \Config\Services::curlrequest();
        $url = 'https://api.purelovers.com/site_builder/';

        try {
            
            $response = $client->get($url, [
                'query' => [
                    'mode' => 'shop_girl_detail',
                    'shop_id' => PURELOVERS_SHOP_ID,
                    'girl_id' => $id
                ]
            ]);
            $cast = json_decode($response->getBody(), true)['data'][0];//var_dump($cast);exit;
        } catch (\Exception $e) {
            return redirect()->to('/cast')->with('error', '記事が見つかりませんでした');
        }

        if (empty($cast)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
// var_dump($diary);exit;
        return view('front/cast_detail', [
            'page_title' => $cast['name'] . ' - プロフィールページ',
            'cast'      => $cast
        ]);
    }
}
