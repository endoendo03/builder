<?php
$router = service('router');
$current_route = $router->getMatchedRouteOptions()['as'] ?? '';

// if (empty($current_route)) {
//     $current_path = current_url(true)->getPath();
// }

$admin_name = session()->get('admin_name') ?? '管理者';
?>

<div class="sidebar-container" style="width: 240px; background: #fff; height: 100vh; border-right: 1px solid #dee2e6; display: flex; flex-direction: column;">
    
    <div style="padding: 20px; border-bottom: 1px solid #eee; background: #f8f9fa;">
        <div style="font-size: 0.8em; color: #666;">ログイン中</div>
        <div style="font-weight: bold; color: #2c3e50;"><?= esc($admin_name) ?> 様</div>
    </div>

    <ul class="admin-menu" style="list-style: none; padding: 0; margin: 0; flex-grow: 1;">
        
        <li class="menu-item <?= ($current_route === 'Admin\Dashboard::index') ? 'active' : '' ?>">
            <a href="<?= url_to('Admin\Dashboard::index') ?>">
                <span class="icon">📊</span> ダッシュボード
            </a>
        </li>

        <li class="menu-item <?= (strpos($current_route, 'Admin\Banner') !== false) ? 'active' : '' ?>">
            <a href="<?= url_to('Admin\Banner::index') ?>">
                <span class="icon">🖼️</span> バナー管理
            </a>
        </li>

        <li class="menu-item <?= (strpos($current_route, 'Admin\Users') !== false) ? 'active' : '' ?>">
            <a href="<?= url_to('Admin\Users::index') ?>">
                <span class="icon">👥</span> 会員管理
            </a>
        </li>

        <li class="menu-item <?= (strpos($current_route, 'Admin\Coupons') !== false) ? 'active' : '' ?>">
            <a href="<?= url_to('Admin\Coupons::index') ?>">
                <span class="icon">🎫</span> クーポン管理
            </a>
        </li>

        <li class="menu-item <?= (strpos($current_route, 'Admin\Surveys') !== false) ? 'active' : '' ?>">
            <a href="<?= url_to('Admin\Surveys::index') ?>">
                <span class="icon">📝</span> アンケート管理
            </a>
        </li>

    </ul>

    <div style="padding: 15px; border-top: 1px solid #eee;">
        <a href="<?= url_to('Admin\Login::logout') ?>" 
           onclick="return confirm('ログアウトしますか？')"
           style="display: block; text-align: center; padding: 10px; background: #e74c3c; color: white; text-decoration: none; border-radius: 4px; font-size: 0.9em; font-weight: bold;">
            ログアウト
        </a>
    </div>
</div>

<style>
/* サイドバーの基本スタイル */
.admin-menu a {
    display: block;
    padding: 15px 20px;
    text-decoration: none;
    color: #333;
    transition: all 0.3s;
    border-left: 4px solid transparent;
}

.admin-menu .icon {
    margin-right: 10px;
}

/* 緑の帯：アクティブ時のスタイル */
.menu-item.active {
    background-color: #f0fdf4; /* 薄い緑背景 */
}

.menu-item.active a {
    color: #27ae60; /* 文字を緑に */
    font-weight: bold;
    border-left: 4px solid #27ae60; /* 左側に濃い緑の帯 */
}

.admin-menu a:hover:not(.active) {
    background-color: #f8f9fa;
    border-left: 4px solid #ddd;
}
</style>