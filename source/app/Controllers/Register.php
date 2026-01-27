<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Register extends BaseController
{
    public function index()
    {
        //
    }
    public function store()
    {
        $model = new \App\Models\UserModel();
        
        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'phone'    => $this->request->getPost('phone'),
            'birthday' => $this->request->getPost('birthday'), // 誕生日を追加
            'role'     => 'member',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $model->insert($data);
        return redirect()->back()->with('message', '会員登録完了！ログインしてください。');
    }
}
