<?php namespace App\Controllers;

class Diary extends BaseController
{
    public function index()
    {
        // APIクライアントの準備
        $client = \Config\Services::curlrequest();
        $url = 'https://api.purelovers.com/site_builder/?mode=shop_girl_diary&shop_id=21151';

        try {
            // 
            $response = $client->get($url, [
                'query' => [
                    'mode' => 'shop_girl_diary',
                    'shop_id' => PURELOVERS_SHOP_ID
                ]
            ]);
            
            $result = json_decode($response->getBody(), true);
            $diaries = $result['data'] ?? [];
        } catch (\Exception $e) {
            // エラー時は空配列にするなどの処理
            $diaries = [];
        }

        $data = [
            'page_title' => '写メ日記一覧',
            'diaries'    => $diaries, // APIの構造に合わせて調整
            // 'pager'      => $this->getDummyPager($diaries['total'] ?? 0), // ページネーション用
        ];

        return view('front/diary_index', $data);
    }
    public function detail($id = null)
    {
        
        $client = \Config\Services::curlrequest();
        $url = 'https://api.purelovers.com/site_builder/';

        try {
            
            $response = $client->get($url, [
                'query' => [
                    'mode' => 'shop_girl_diary_detail',
                    'shop_id' => PURELOVERS_SHOP_ID,
                    'diary_id' => $id
                ]
            ]);
            $diary = json_decode($response->getBody(), true)['data'];
        } catch (\Exception $e) {
            return redirect()->to('/diary')->with('error', '記事が見つかりませんでした');
        }

        if (empty($diary)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
// var_dump($diary);exit;
        return view('front/diary_detail', [
            'page_title' => $diary['subject'] . ' - 写メ日記',
            'diary'      => $diary
        ]);
    }
}