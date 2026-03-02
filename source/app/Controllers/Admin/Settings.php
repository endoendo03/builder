<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingModel;

class Settings extends BaseController
{
    public function index()
    {
        $model = new SettingModel();
        $data['settings'] = $model->getKeyValuePairs();
        return view('admin/settings/index', $data);
    }

    public function update()
    {
        $model = new SettingModel();
        $posts = $this->request->getPost('settings'); // settings[key] = value の形式で受け取る

        foreach ($posts as $key => $value) {
            $model->save([
                'key'   => $key,
                'value' => $value
            ]);
        }

        return redirect()->back()->with('success', '設定を更新しました！');
    }
}