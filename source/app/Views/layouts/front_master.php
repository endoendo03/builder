<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($page_title ?? '人妻レンタル NTR') ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const trigger = document.getElementById('menu-trigger');
            const menu = document.getElementById('nav-menu');
            const overlay = document.getElementById('menu-overlay');

            function toggleMenu() {
                trigger.classList.toggle('active');
                menu.classList.toggle('active');
                overlay.classList.toggle('active');
            }

            trigger.addEventListener('click', toggleMenu);
            overlay.addEventListener('click', toggleMenu);
        });
    </script>
</head>
<body>
<?= $this->include('layouts/_login_modal') ?>
<?= $this->include('layouts/_register_modal') ?>
<header class="site-header">
    <div class="header-inner">
        <img src="/images/logo_1727263371.png" alt="LOGO" style="height: 50px;">
        
        <button class="menu-trigger" id="menu-trigger">
            <span></span><span></span><span></span>
        </button>

        <ul class="nav-menu" id="nav-menu">
            <li><a href="/system/">料金システム</a></li>
            <li><a href="/coupon/">クーポン</a></li>
            <li><a href="/cast/">キャスト一覧</a></li>
            <li><a href="/schedule/">出勤一覧</a></li>
            <li><a href="<?= base_url('diary') ?>">写メ日記</a></li>

            <?php if (session()->get('is_user_logged_in')): ?>
                <li class="user-welcome">ようこそ、<?= esc(session()->get('user_name')) ?> 様</li>
                <li><a href="<?= base_url('logout') ?>" onclick="return confirm('ログアウトしますか？')">ログアウト</a></li>
            <?php else: ?>
                <li><a href="javascript:void(0)" onclick="openLoginModal()" style="color:#ff0;">ログイン / 会員登録</a></li>
            <?php endif; ?>
            <?= view_cell('\App\Libraries\BannerLibrary::displaySurvey') ?>
        </ul>
    </div>
</header>
<div class="menu-overlay" id="menu-overlay"></div>
<?php if (session()->getFlashdata('message')): ?>
    <div style="background: #27ae60; color: white; padding: 15px; text-align: center; font-size: 14px; z-index: 10001; position: relative;">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php endif; ?>
<?php
    // 現在のページがTOP（Home）かどうかを判定
    $uri = service('uri');
    $isHome = ($uri->getSegment(1) == '' || $uri->getSegment(1) == 'index');
?>

<?php if ($isHome): ?>
    <section class="main-visual">
        <?= view_cell('\App\Libraries\BannerLibrary::display', ['place' => 'top_pc']) ?>
        <?= view_cell('\App\Libraries\BannerLibrary::display', ['place' => 'top_sp']) ?>
    </section>
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
    
    <div class="side-content" style="width: 300px;">
        <?= view('parts/right_column') ?>
    </div>
</div>
<footer>
    Copyright &copy; 人妻レンタル NTR All Rights Reserved.
</footer>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // PC用バナーの設定
    const swiperPc = new Swiper('.sh-banner-pc', {
        loop: true,
        effect: 'fade', // フェードエフェクト
        fadeEffect: { crossFade: true },
        autoplay: {
            delay: 5000, // 5秒ごとに切り替え
            disableOnInteraction: false,
        },
        speed: 2000, // 切り替わる時のじわっと感（2秒）
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    // スマホ用バナーの設定
    const swiperSp = new Swiper('.sh-banner-sp', {
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        speed: 1000,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
});

    function openLoginModal() {
        document.getElementById('loginModal').style.display = 'flex';
    }

    function closeLoginModal() {
        document.getElementById('loginModal').style.display = 'none';
    }

    // 登録モーダルへの切り替え
    function openRegisterFromLogin() {
        closeLoginModal();
        document.getElementById('registerModal').style.display = 'flex';
    }

    function closeRegisterModal() {
        document.getElementById('registerModal').style.display = 'none';
    }

    // 外側をクリックしたら閉じる（共通）
    window.onclick = function(event) {
        if (event.target.classList.contains('modal-overlay')) {
            event.target.style.display = 'none';
        }
    }
</script>
</body>
</html>