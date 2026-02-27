<?php

namespace App\Libraries;

use App\Models\BannerModel;
use App\Models\SurveyModel;

class BannerLibrary
{
    /**
     * 【決定版】これ一つで全ての場所のバナーを表示します
     * $params['place'] によって読み込むViewとデータを自動切り替え
     */
    public function display(array $params)
    {
        $place = $params['place'] ?? 'top_pc';
        $model = new BannerModel();

        // 1. DBから該当箇所のバナーを取得
        $banners = $model->where('place', $place)
                         ->orderBy('sort_order', 'ASC')
                         ->findAll();
        
        $data = [
            'banners' => $banners,
            'place'   => $place
        ];

        // 2. place名に応じてViewを切り替える（ファイル名と連動）
        // 例: top_pc なら parts/banner_top_pc_cell.php を探す
        $viewName = "parts/banner_{$place}_cell";
        
        // ※もしViewが細かく分かれていない場合は 'parts/banner_common_cell' など固定でもOK
        return view($viewName, $data);
    }

    /**
     * アンケート用のCell（これはそのまま活用）
     */
    public function displaySurvey()
    {
        $model = new SurveyModel();
        $data['survey'] = $model->where('is_published', 1)->first();
        
        return view('parts/survey', $data);
    }
}