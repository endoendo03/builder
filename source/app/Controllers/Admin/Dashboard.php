<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    /**
     * 管理画面のトップページ（ダッシュボード）を表示する
     */
    public function index()
    {
        // ここでデータベースからのデータ取得などのロジックを記述する

        // ビューに渡すデータ (例)
        $data = [
            'page_title' => 'ダッシュボード',
            'latest_users_count' => 15,
            'latest_sales_amount' => '¥2,300,000',
        ];

        // 'admin/dashboard' ビューファイルを読み込む
        // このビューファイルは、layouts/admin_master.php を継承している前提
        return view('admin/dashboard', $data);
    }
}