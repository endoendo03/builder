<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;

class Login extends BaseController
{
    public function auth()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // メールアドレスでユーザーを検索
        $user = $model->where('email', $email)->first();

        if ($user) {
            // パスワードの照合
            if (password_verify($password, $user['password'])) {
                // セッションにユーザー情報を保存
                $session->set([
                    'user_id'    => $user['id'],
                    'user_name'  => $user['username'],
                    'is_user_logged_in' => true,
                ]);

                return redirect()->to('/')->with('message', 'ログインしました！');
            } else {
                return redirect()->back()->with('error', 'パスワードが正しくありません');
            }
        } else {
            return redirect()->back()->with('error', 'メールアドレスが見つかりません');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('message', 'ログアウトしました');
    }
}
