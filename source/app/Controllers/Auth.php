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

        // 2. トークン生成（本登録URL用）
        $token = bin2hex(random_bytes(32));

        $userModel = new UserModel();

        // 3. データの保存（statusを 'inactive' に！）
        $userModel->save([
            'email'         => $email,
            'password'      => password_hash($password, PASSWORD_DEFAULT),
            'username'      => $username,
            'birthday'      => $birthday,
            'status'        => 'inactive', // ← ここ重要！
            'token'         => $token,
            'token_expires' => Time::now()->addHours(24)->toDateTimeString(),
        ]);

        // 4. Gmail送信
        if ($this->_sendActivationEmail($email, $token)) {
            return redirect()->to('/')->with('message', '仮登録メールを送信しました。メール内のリンクから本登録を完了してください！');
        } else {
            return redirect()->back()->with('error', 'メール送信に失敗しました。設定を確認してください。');
        }
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
}