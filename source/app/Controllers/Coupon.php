<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CouponModel;

class Coupon extends BaseController
{
    public function index()
    {
        $model = new CouponModel();
        
        // 管理画面で作ったクーポンを取得
        $coupons = $model->where('status', 'active')
                         ->orderBy('created_at', 'desc')
                         ->findAll();

        return view('front/coupon_index', [
            'page_title' => '会員様限定クーポン',
            'coupons'    => $coupons,
            'is_logged_in' => session()->get('is_user_logged_in') // ログイン状態を渡す
        ]);
    }
}
