<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($page_title ?? '人妻レンタル NTR') ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <style>
        /* 背景画像の設定 */
        
    </style>
</head>
<body>
<?= $this->include('layouts/_register_modal') ?>
<?= $this->include('layouts/_login_modal') ?>
<header>
    <div class="header-inner">
        <img src="/images/logo_1727263371.png" alt="LOGO" style="height: 50px;">
        <ul class="nav-menu">
            <li><a href="/system/">料金システム</a></li>
            <li><a href="/cast/">キャスト一覧</a></li>
            <li><a href="<?= base_url('diary') ?>">写メ日記</a></li>

            <?php if (session()->get('is_user_logged_in')): ?>
                <li style="color: #ff0; padding: 0 10px;">ようこそ、<?= esc(session()->get('user_name')) ?> 様</li>
                <li><a href="<?= base_url('logout') ?>" onclick="return confirm('ログアウトしますか？')">ログアウト</a></li>
            <?php else: ?>
                <li><a href="javascript:void(0)" onclick="openLoginModal()" style="color:#ff0;">ログイン / 会員登録</a></li>
            <?php endif; ?>
        </ul>
    </div>
</header>
<?php if (session()->getFlashdata('message')): ?>
    <div style="background: #27ae60; color: white; padding: 10px; text-align: center; font-size: 12px;">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div style="background: #e74c3c; color: white; padding: 10px; text-align: center; font-size: 12px;">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>
<div class="container" style="background-color:black;">
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <aside class="sidebar-right">
        <?= $this->include('layouts/_front_sidebar') ?>
    </aside>
</div>
<footer>
    Copyright &copy; 人妻レンタル NTR All Rights Reserved.
</footer>

</body>
</html>