<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class Auth extends BaseController
{
    public function registerStore()
    {
        // 1. 入力値の取得
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $birthday = $this->request->getPost('birthday');

        // usernameがNOT NULLなので、とりあえずメールの@前を仮入れ
        $username = explode('@', $email)[0];

        $token = bin2hex(random_bytes(32));
    
        // DB保存
        $userModel = new UserModel();
        $userModel->save([
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'username' => explode('@', $email)[0],
            'birthday' => $this->request->getPost('birthday'),
            'status'   => 'inactive',
            'token'    => $token,
            'token_expires' => Time::now()->addHours(24)->toDateTimeString(),
        ]);

        // 本登録用のURLを生成
        $activationUrl = site_url("activate/{$token}");

        // 本来はメール送信だが、開発用としてメッセージにURLをブチ込む！
        return redirect()->to('/')->with('message', "【開発用】メールの代わりにこちらをクリック：<a href='{$activationUrl}'>本登録を完了する</a>");
    }

    private function _sendActivationEmail($to, $token)
    {
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setSubject('【NTR仙台店】会員登録を完了させてください');
        
        // 本登録用URL
        $url = site_url("activate/{$token}");
        
        $message = "人妻レンタル NTR 仙台店へようこそ！\n\n"
                 . "以下のURLをクリックして、本登録を完了させてください。\n"
                 . $url . "\n\n"
                 . "※有効期限は24時間です。";
        
        $email->setMessage($message);
        return $email->send();
    }
    public function activate($token = null)
    {
        $userModel = new \App\Models\UserModel();

        // 1. トークンが一致し、かつ有効期限内のユーザーを探す
        $user = $userModel->where('token', $token)
                        ->where('status', 'inactive')
                        ->where('token_expires >=', date('Y-m-d H:i:s'))
                        ->first();

        if (!$user) {
            return redirect()->to('/')->with('error', 'このURLは無効か、有効期限が切れています。再度登録を試みてください。');
        }

        // 2. 本登録完了！ statusを active に更新
        $userModel->update($user['id'], [
            'status'        => 'active',
            'token'         => null,      // 使い終わったトークンは消す
            'token_expires' => null       // 期限もリセット
        ]);

        // 3. せっかくなのでそのままログイン状態にしてあげると親切
        session()->set([
            'user_id'           => $user['id'],
            'user_name'         => $user['username'],
            'is_user_logged_in' => true,
        ]);

        return redirect()->to('/')->with('message', '本登録が完了しました！なまれんへようこそ！');
    }

    // 申請画面（メルアド入力ページ）を表示する場合
    public function forgotPasswordView()
    {
        return view('auth/forgot_password');
    }
    
    public function forgotPasswordStore()
    {
        $email = $this->request->getPost('email');
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $email)->where('status', 'active')->first();

        if ($user) {
            $token = bin2hex(random_bytes(32));
            $userModel->update($user['id'], [
                'token'         => $token,
                'token_expires' => \CodeIgniter\I18n\Time::now()->addHours(1)->toDateTimeString()
            ]);

            $resetUrl = site_url("password/reset/{$token}");
            
            // 開発用：画面にURLを出す
            return redirect()->back()->with('message', "【開発用】リセットURL：<a href='{$resetUrl}'>パスワードを再設定する</a>");
        }

        return redirect()->back()->with('message', '登録があればリセット案内を送信しました。');
    }

    // --- ② 再設定画面の表示 ---
    public function passwordResetView($token = null)
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('token', $token)
                        ->where('token_expires >=', date('Y-m-d H:i:s'))
                        ->first();

        if (!$user) {
            return redirect()->to('/')->with('error', 'URLが無効か期限切れです。');
        }

        // 再設定用の入力画面を表示（専用のViewを呼び出す）
        return view('auth/reset_password', ['token' => $token]);
    }

    // --- ③ パスワード更新の実行 ---
    public function passwordUpdate()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('token', $token)->first();

        if ($user) {
            $userModel->update($user['id'], [
                'password'      => password_hash($password, PASSWORD_DEFAULT),
                'token'         => null,
                'token_expires' => null
            ]);
            return redirect()->to('/')->with('message', 'パスワードを変更しました。新しいパスワードでログインしてください！');
        }

        return redirect()->to('/')->with('error', 'エラーが発生しました。');
    }
}