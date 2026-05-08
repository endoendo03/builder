<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AgeGateFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 🌟 追加：Googleなどのクローラー（ロボット）か判定
        $agent = $request->getUserAgent();
        if ($agent->isRobot()) {
            return; // ロボットならここでチェック終了！顔パスで通す！
        }

        // --- ここから下は人間用の処理 ---
        helper('cookie');

        if (!get_cookie('is_adult')) {
            $currentPath = trim($request->getUri()->getPath(), '/');
            if ($currentPath !== 'age-verification' && $currentPath !== 'verify-age') {
                return redirect()->to('/age-verification');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // 処理なし
    }
}