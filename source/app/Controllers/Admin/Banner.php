<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BannerModel;

class Banner extends BaseController
{
    protected $bannerModel;

    private $bannerSettings = [
        'top_pc' => [
            'label' => 'TOPバナー(PC)',
            'limit' => 5,
            'desc'  => '推奨: 1920x600'
        ],
        'top_sp' => [
            'label' => 'TOPバナー(SP)',
            'limit' => 5,
            'desc'  => '推奨: 800x800'
        ],
        'right_column' => [
            'label' => '右カラム',
            'limit' => 5,
            'desc'  => '推奨: 300x250'
        ],
        'render_shop' => [
            'label' => '系列店バナー',
            'limit' => 6,
            'desc'  => '系列店バナー'
        ],
        'top_main' => [
            'label' => 'TOPページメインカラム',
            'limit' => 10,
            'desc'  => 'TOPページメインカラム'
        ],
    ];

    public function __construct()
    {
        $this->bannerModel = new BannerModel();
    }

    public function index()
    {
        $model = new BannerModel();
        
        // placeごとにグループ化して取得
        $allBanners = $model->orderBy('sort_order', 'ASC')->findAll();
        $bannersByPlace = [];
        foreach ($allBanners as $b) {
            $bannersByPlace[$b['place']][] = $b;
        }

        return view('admin/banner/index', [
            'title'    => 'バナー管理',
            'settings' => $this->bannerSettings,
            'banners'  => $bannersByPlace
        ]);
    }

    /**
     * 新規登録画面（どの枠か place をクエリパラメータで受け取る）
     */
    public function new()
    {
        $place = $this->request->getGet('place');

        // 定義にないplaceや、枚数オーバーをチェック
        if (!isset($this->bannerSettings[$place])) {
            return redirect()->to('/admin/banner')->with('error', '無効な場所です。');
        }

        $model = new BannerModel();
        $currentCount = $model->where('place', $place)->countAllResults();

        if ($currentCount >= $this->bannerSettings[$place]['limit']) {
            return redirect()->to('/admin/banner')->with('error', 'これ以上登録できません。');
        }

        return view('admin/banner/new', [
            'place' => $place,
            'info'  => $this->bannerSettings[$place]
        ]);
    }

    public function create()
    {
        $model = new \App\Models\BannerModel();

        // 1. バリデーション設定
        $validationRule = [
            'title' => 'required|min_length[3]',
            'image' => [
                'label' => 'Image File',
                'rules' => 'uploaded[image]'
                        . '|is_image[image]'
                        . '|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]'
                        . '|max_size[image,4096]', // 最大4MB
            ],
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->back()->withInput()->with('error', '入力内容または画像を確認してください。');
        }

        // 2. 画像ファイルの処理
        $img = $this->request->getFile('image');
        
        if (!$img->hasMoved()) {
            // public/uploads/banners フォルダにランダムな名前で保存
            $newName = $img->getRandomName();
            $img->move(ROOTPATH . 'public/uploads/banners', $newName);
            
            // DBに保存するパスを作成
            $imagePath = 'uploads/banners/' . $newName;
        } else {
            return redirect()->back()->with('error', '画像のアップロードに失敗しました。');
        }

        // 3. DBへの保存データ作成
        $data = [
            'place'      => $this->request->getPost('place'),
            'title'      => $this->request->getPost('title'),
            'image_path' => $imagePath,
            'link_url'   => $this->request->getPost('link_url'),
            'alt_text'   => $this->request->getPost('alt_text'),
            'sort_order' => 0, // 必要なら最小値-1ロジックをここにも
        ];

        if ($model->insert($data)) {
            return redirect()->to('/admin/banner/index')->with('success', 'バナーを登録しました！');
        } else {
            return redirect()->back()->with('error', 'DB保存に失敗しました。');
        }
    }

    public function update_place()
    {
        $place = $this->request->getPost('place'); 
        $file  = $this->request->getFile('image');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/banners', $newName);
            $path = 'uploads/banners/' . $newName;

            // DBにすでにあるかチェックして保存（updateOrInsert的な動き）
            $model = new \App\Models\BannerModel();
            $existing = $model->where('place', $place)->first();

            $data = [
                'place'      => $place,
                'title'      => $this->request->getPost('title'),
                'image_path' => $path,
                'alt_text'   => $this->request->getPost('alt_text'),
                'link_url'   => $this->request->getPost('link_url'),
            ];

            if ($existing) {
                $model->update($existing['id'], $data);
            } else {
                $model->insert($data);
            }
        }
        return redirect()->back()->with('success', 'バナーを更新しました！');
    }

    public function reorder()
    {
        $ids = $this->request->getJSON(true)['ids'] ?? [];
        $model = new \App\Models\BannerModel();

        foreach ($ids as $index => $id) {
            $model->update($id, ['sort_order' => $index]);
        }

        return $this->response->setJSON(['status' => 'success']);
    }

    public function delete($id)
    {
        $model = new \App\Models\BannerModel();
        $banner = $model->find($id);

        if ($banner) {
            // サーバー上の画像ファイルを削除
            $filePath = ROOTPATH . 'public/' . $banner['image_path'];
            if (is_file($filePath)) {
                unlink($filePath);
            }

            // DBレコードを削除
            $model->delete($id);
            return redirect()->back()->with('success', 'バナーを削除しました。');
        }

        return redirect()->back()->with('error', 'バナーが見つかりませんでした。');
    }
}