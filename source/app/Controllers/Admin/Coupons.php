<?php 
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CouponModel;

class Coupons extends BaseController
{
    public function index()
    {
        $model = new CouponModel();
        $data = [
            'page_title' => 'クーポン管理',
            'coupons'    => $model->orderBy('id', 'desc')->findAll(),
        ];
        return view('admin/coupons/index', $data);
    }

    // 1. 新規登録画面を表示する
    public function new()
    {
        $data = [
            'page_title' => 'クーポン新規発行',
            'validation' => \Config\Services::validation(), // バリデーション用
        ];
        return view('admin/coupons/new', $data);
    }

    // 2. データを保存する
    public function create()
    {
        $model = new CouponModel();

        // 入力データの取得
        $data = [
            'name'        => $this->request->getPost('name'),
            'code'        => $this->request->getPost('code'),
            'discount'    => $this->request->getPost('discount'),
            'expire_date' => $this->request->getPost('expire_date'),
        ];

        // 保存実行（モデルの $allowedFields が効いているので安全です）
        if ($model->insert($data)) {
            // 成功したら一覧へ戻る（フラッシュメッセージを添えて）
            return redirect()->to(url_to('Admin\Coupons::index'))->with('success', 'クーポンを発行しました！');
        } else {
            // 失敗したら入力画面に戻る（エラーを表示）
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }
    // 3. 編集画面を表示する
    public function edit($id = null)
    {
        $model = new CouponModel();
        $coupon = $model->find($id); // IDで検索

        if (!$coupon) {
            return redirect()->to(url_to('Admin\Coupons::index'))->with('error', '指定されたクーポンは見つかりませんでした。');
        }

        $data = [
            'page_title' => 'クーポン編集',
            'coupon'     => $coupon,
        ];
        return view('admin/coupons/edit', $data);
    }

    // 4. データを更新する
    public function update($id = null)
    {
        $model = new CouponModel();

        $data = [
            'name'        => $this->request->getPost('name'),
            'code'        => $this->request->getPost('code'),
            'discount'    => $this->request->getPost('discount'),
            'expire_date' => $this->request->getPost('expire_date'),
        ];

        if ($model->update($id, $data)) {
            return redirect()->to(url_to('Admin\Coupons::index'))->with('success', 'クーポンを更新しました！');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }
}