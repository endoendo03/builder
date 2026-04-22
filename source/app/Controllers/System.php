<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TransportFeeModel;

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

            // 交通費データを取得し、区（ward）と行（syllabary）ごとにグループ化する
            $transportFeeModel = new \App\Models\TransportFeeModel(); // モデルを作っている前提
            $rawFees = $transportFeeModel->orderBy('syllabary', 'ASC')->orderBy('town_name', 'ASC')->findAll();

            $groupedFees = [];
            foreach ($rawFees as $fee) {
                $groupedFees[$fee['ward']][$fee['syllabary']][] = $fee;
            }

            // （もし settings テーブルからフリーテキストを取得していればそれも渡す）
            $transportFeeNote = $settings['transport_fee_note'] ?? '※仙台市外の方はお気軽にご相談ください。';

            $systemData['groupedFees'] = $groupedFees;
            $systemData['transportFeeNote'] = $transportFeeNote;
        } catch (\Exception $e) {
            $systemData = [];
        }

        return view('front/system_index', [
            'page_title' => '料金システム',
            'system'     => $systemData
        ]);
    }
}
