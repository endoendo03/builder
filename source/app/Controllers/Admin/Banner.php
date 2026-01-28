<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BannerModel;

class Banner extends BaseController
{
    protected $bannerModel;

    public function __construct()
    {
        $this->bannerModel = new BannerModel();
    }

    /**
     * TOPバナー一覧
     */
    public function top_index()
    {
        $data = [
            'title'   => 'TOPバナー管理',
            'banners' => $this->bannerModel->orderBy('sort_order', 'ASC')->findAll(),
        ];
        return view('admin/banner/top_index', $data);
    }

    /**
     * TOPバナー新規登録画面
     */
    public function top_new()
    {
        // 現在の枚数チェック
        if ($this->bannerModel->countAllResults() >= 5) {
            return redirect()->to('/admin/banner/top_index')->with('error', 'バナーは最大5枚までです。');
        }

        return view('admin/banner/top_new', ['title' => 'TOPバナー新規登録']);
    }

    /**
     * TOPバナー保存処理
     */
    public function top_store()
    {
        // 1. バリデーション
        $rules = [
            'title'    => 'required|max_length[255]',
            // 'pc_image' => 'uploaded[pc_image]|is_image[pc_image]|max_size[pc_image,20480]',
            // 'sp_image' => 'uploaded[sp_image]|is_image[sp_image]|max_size[sp_image,20480]',
            'alt_text' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. 枚数制限（念のための二重チェック）
        if ($this->bannerModel->countAllResults() >= 5) {
            return redirect()->to('/admin/banner/top_index')->with('error', 'バナーは最大5枚までです。');
        }

        // 3. 画像アップロード処理
        $pcFile = $this->request->getFile('pc_image');
        $spFile = $this->request->getFile('sp_image');

        $pcName = $pcFile->getRandomName();
        $spName = $spFile->getRandomName();

        // public/uploads/banners に保存
        $pcFile->move(FCPATH . 'uploads/banners/', $pcName);
        $spFile->move(FCPATH . 'uploads/banners/', $spName);

        // 4. DB保存
        $this->bannerModel->save([
            'title'         => $this->request->getPost('title'),
            'alt_text'      => $this->request->getPost('alt_text'),
            'link_url'      => $this->request->getPost('link_url'),
            'pc_image_path' => 'uploads/banners/' . $pcName,
            'sp_image_path' => 'uploads/banners/' . $spName,
            'sort_order'    => $this->request->getPost('sort_order') ?? 0,
            'is_visible'    => 1,
        ]);

        return redirect()->to('/admin/banner/top_index')->with('success', 'バナーを登録しました。');
    }

    /**
     * TOPバナー削除
     */
    public function top_delete($id = null)
    {
        $banner = $this->bannerModel->find($id);
        if (!$banner) {
            return redirect()->to('/admin/banner/top_index')->with('error', 'データが見つかりません。');
        }

        // 物理ファイルの削除
        if (file_exists(FCPATH . $banner['pc_image_path'])) unlink(FCPATH . $banner['pc_image_path']);
        if (file_exists(FCPATH . $banner['sp_image_path'])) unlink(FCPATH . $banner['sp_image_path']);

        $this->bannerModel->delete($id);

        return redirect()->to('/admin/banner/top_index')->with('success', 'バナーを削除しました。');
    }
}