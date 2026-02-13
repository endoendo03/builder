<?php

namespace App\Libraries;

use App\Models\BannerModel;
use App\Models\SurveyModel;

class BannerLibrary
{
    /**
     * 指定された場所のバナーを表示する
     */
    public function displayPcTop(array $params)
    {
        $place = $params['place'] ?? 'top_pc';
        $model = new BannerModel();

        // 公開中のバナーを順序通りに取得
        $data['banners'] = $model->where('place', $place)
                                 ->orderBy('sort_order', 'ASC')
                                 ->findAll();
        
        $data['place'] = $place;

        // ライブラリ専用の「パーツ用View」を返す
        return view('parts/banner_top_pc_cell', $data);
    }
    
    /**
     * 指定された場所のバナーを表示する
     */
    public function displaySpTop(array $params)
    {
        $place = 'top_pc';
        $model = new BannerModel();

        // 公開中のバナーを順序通りに取得
        $data['banners'] = $model->where('place', $place)
                                 ->orderBy('sort_order', 'ASC')
                                 ->findAll();
        
        $data['place'] = $place;

        // ライブラリ専用の「パーツ用View」を返す
        return view('parts/banner_top_sp_cell', $data);
    }
    
    /**
     * 指定された場所のバナーを表示する
     */
    public function displayRightColumn()
    {
        $place = $params['place'] ?? 'right_column';
        $model = new BannerModel();

        // 公開中のバナーを順序通りに取得
        $data['banners'] = $model->where('place', $place)
                                 ->orderBy('sort_order', 'ASC')
                                 ->findAll();
        
        $data['place'] = $place;

        // ライブラリ専用の「パーツ用View」を返す
        return view('parts/banner_right_column_cell', $data);
    }
    
    /**
     * 指定された場所のバナーを表示する
     */
    public function displayRenderShop()
    {
        $place = $params['place'] ?? 'render_shop';
        $model = new BannerModel();

        // 公開中のバナーを順序通りに取得
        $data['banners'] = $model->where('place', $place)
                                 ->orderBy('sort_order', 'ASC')
                                 ->findAll();
        
        $data['place'] = $place;

        // ライブラリ専用の「パーツ用View」を返す
        return view('parts/banner_render_shop', $data);
    }
    
    /**
     * 指定された場所のバナーを表示する
     */
    public function displaySurvey()
    {
        $model = new SurveyModel();

        // 公開中のバナーを順序通りに取得
        $data['survey'] = $model->where('is_published', 1)
                                 ->first();
        // ライブラリ専用の「パーツ用View」を返す
        return view('parts/survey', $data);
    }
}