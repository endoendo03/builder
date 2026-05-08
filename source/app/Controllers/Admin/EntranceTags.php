<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiteSettingModel;

class EntranceTags extends BaseController
{
    public function index()
    {
        $model = new SiteSettingModel();
        
        // 🌟 ID:2 を「年齢認証ページ専用」として取得
        $data['setting'] = $model->find(2);
        
        // もし2行目がまだDBに存在しなければ、空で自動作成しておく
        if (!$data['setting']) {
            $model->insert(['id' => 2, 'header_tags' => '', 'footer_tags' => '']);
            $data['setting'] = $model->find(2);
        }

        return view('admin/entrance_tags/index', $data);
    }

    public function update()
    {
        $model = new SiteSettingModel();
        
        $data = [
            'header_tags' => $this->request->getPost('header_tags'),
            'footer_tags' => $this->request->getPost('footer_tags'),
        ];

        // 🌟 ID:2 を更新
        $model->update(2, $data);

        return redirect()->to('admin/entrance_tags')->with('message', '年齢認証ページ用のタグを保存しました！');
    }
}