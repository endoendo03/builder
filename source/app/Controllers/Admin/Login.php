<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Login extends BaseController
{
    public function index()
    {
        return view('admin/login');
    }

    public function attempt()
    {
        $session = session();
        $model = new AdminModel();
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        $admin = $model->where('username', $username)->first();
        
        if ($admin && password_verify($password, $admin['password'])) {
            // ログイン成功：セッションにIDを保存
            $session->set([
                'admin_id'   => $admin['id'],
                'admin_name' => $admin['username'],
                'admin_role' => $admin['role'],
                'is_logged_in' => true,
            ]);
            return redirect()->to(url_to('Admin\Dashboard::index'));
        } else {
            // 失敗
            return redirect()->back()->with('error', 'ユーザー名またはパスワードが違います');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(url_to('Admin\Login::index'));
    }
}