<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Index extends BaseController
{
    public function index()
    {
        $data = [];
        // APIクライアントの準備
        $client = \Config\Services::curlrequest();
        $url = 'https://api.purelovers.com/site_builder/?mode=shop_basic&shop_id=' .PURELOVERS_SHOP_ID;

        try {
            // 
            $response = $client->get($url, [
                'query' => [
                    'mode' => 'shop_basic',
                    'shop_id' => PURELOVERS_SHOP_ID
                ]
            ]);
            
            $result = json_decode($response->getBody(), true);
            $basicData = $result['data'] ?? [];
        } catch (\Exception $e) {
            // エラー時は空配列にするなどの処理
            $basicData = [];
        }
        
        $s = $this->settings;
        // 1. 出勤情報 (API)
        if (($s['display_attendance'] ?? '0') === '1') {
            $data['attendance'] = $this->_fetchAttendance(); 
        }

        // 2. 生動画 (API)
        if (($s['display_raw_video'] ?? '0') === '1') {
            $data['raw_videos'] = $this->_fetchVideos();
        }

        // 3. 体験動画 (API)
        if (($s['display_exp_video'] ?? '0') === '1') {
            $data['exp_videos'] = $basicData['ex-movie'] ?? [];
        }

        // 4. 体験漫画 (API)
        if (($s['display_exp_manga'] ?? '0') === '1') {
            $data['exp_comic'] = $basicData['ex-comic'] ?? [];
        }
        $surveyModel = new \App\Models\SurveyModel();

        $data['activeSurvey'] = $surveyModel->where('is_published', 1)->first();
// var_dump($data);exit;
        return view('front/top', $data);
    }

    public function top()
    {
        
        $data = [];
        // APIクライアントの準備
        $client = \Config\Services::curlrequest();
        $url = 'https://api.purelovers.com/site_builder/?mode=shop_basic&shop_id=' .PURELOVERS_SHOP_ID;

        try {
            // 
            $response = $client->get($url, [
                'query' => [
                    'mode' => 'shop_basic',
                    'shop_id' => PURELOVERS_SHOP_ID
                ]
            ]);
            
            $result = json_decode($response->getBody(), true);
            $basicData = $result['data'] ?? [];
        } catch (\Exception $e) {
            // エラー時は空配列にするなどの処理
            $basicData = [];
        }
        
        $s = $this->settings;
        // 1. 出勤情報 (API)
        if (($s['display_attendance'] ?? '0') === '1') {
            $data['attendance'] = $this->_fetchAttendance(); 
        }

        // 2. 生動画 (API)
        if (($s['display_raw_video'] ?? '0') === '1') {
            $data['raw_videos'] = $this->_fetchVideos();
        }

        // 3. 体験動画 (API)
        if (($s['display_exp_video'] ?? '0') === '1') {
            $data['exp_videos'] = $basicData['ex-movie'] ?? [];
        }

        // 4. 体験漫画 (API)
        if (($s['display_exp_manga'] ?? '0') === '1') {
            $data['exp_comic'] = $basicData['ex-comic'] ?? [];
        }
        $surveyModel = new \App\Models\SurveyModel();

        $data['activeSurvey'] = $surveyModel->where('is_published', 1)->first();

        return view('front/top', $data);
    }
    

    // 
    private function _fetchAttendance() {
        // APIクライアントの準備
        $client = \Config\Services::curlrequest();
        $url = 'https://api.purelovers.com/site_builder/?mode=shop_girl&shop_id=' .PURELOVERS_SHOP_ID;

        try {
            // 
            $response = $client->get($url, [
                'query' => [
                    'mode' => 'shop_girl',
                    'shop_id' => PURELOVERS_SHOP_ID
                ]
            ]);
            
            $result = json_decode($response->getBody(), true);
            $girlData = $result['data'] ?? [];
            $girlData = array_slice($girlData, 0, 6);
            
        } catch (\Exception $e) {
            // エラー時は空配列にするなどの処理
            $girlData = [];
        }
        return $girlData;
    }

    private function _fetchVideos() {
        // API通信してデータがあれば配列、なければ空
        // APIクライアントの準備
        $client = \Config\Services::curlrequest();
        $url = 'https://api.purelovers.com/site_builder/?mode=shop_movie&shop_id=' .PURELOVERS_SHOP_ID;

        try {
            // 
            $response = $client->get($url, [
                'query' => [
                    'mode' => 'shop_movie',
                    'shop_id' => PURELOVERS_SHOP_ID
                ]
            ]);
            
            $result = json_decode($response->getBody(), true);
            $movieData = $result['data'] ?? [];

            $movieData = $movieData['raw_videos'] ?? [];

        } catch (\Exception $e) {
            // エラー時は空配列にするなどの処理
            $movieData = [];
        }
        return array_slice($movieData, 0, 4); 
    }
}
