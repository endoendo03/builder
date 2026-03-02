<?php

namespace App\Libraries;

use App\Models\BannerModel;
use App\Models\SurveyModel;

class BannerLibrary
{
    /**
     * バナー表示の共通エントリーポイント
     */
    public function display(array $params)
    {
        $place = $params['place'] ?? 'top_pc';
        $model = new BannerModel();

        $data['banners'] = $model->where('place', $place)
                                 ->orderBy('sort_order', 'ASC')
                                 ->findAll();
        $data['place'] = $place;

        // place名が 'top_pc' なら 'parts/banner_top_pc_cell.php' を読み込む
        return view("parts/banner_{$place}_cell", $data);
    }

    /**
     * アンケート用のCell
     */
    public function displaySurvey()
    {
        $model = new SurveyModel();
        $data['survey'] = $model->where('is_published', 1)->first();
        return view('parts/survey', $data);
    }
}