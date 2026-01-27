<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends BaseController
{
    public function index()
    {
        $model = new \App\Models\UserModel();
    
        // 検索値の取得
        $search = $this->request->getGet();
        
        // クエリの作成
        $query = $model;

        if (!empty($search['username'])) {
            $query = $query->like('username', $search['username']);
        }
        if (!empty($search['email'])) {
            $query = $query->like('email', $search['email']);
        }
        if (!empty($search['phone'])) {
            $query = $query->like('phone', $search['phone']);
        }
        if (!empty($search['status'])) {
            $query = $query->where('status', $search['status']);
        }

        $data = [
            'page_title' => '会員管理',
            'users'      => $query->orderBy('id', 'desc')->findAll(),
            'search'     => $search, // 入力値を保持するために渡す
        ];

        return view('admin/users/index', $data);
    }
    public function edit($id = null)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'ユーザーが見つかりません');
        }

        return view('admin/users/edit', [
            'page_title' => '会員詳細・編集',
            'user'       => $user
        ]);
    }

    public function update($id = null)
    {
        $model = new UserModel();
        $data = $this->request->getPost(); // 全データ取得

        if ($model->update($id, $data)) {
            return redirect()->to(url_to('Admin\Users::index'))->with('success', '会員情報を更新しました');
        }
        return redirect()->back()->withInput();
    }
}
