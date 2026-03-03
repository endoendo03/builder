<aside class="right-column">

    <section class="rc-section u-hidden-sp">
        <!-- <h3 class="rc-title">MOBILE PREVIEW</h3> -->
        <div class="rc-banner-wrap mobile-style">
            <?= view_cell('\App\Libraries\BannerLibrary::display', ['place' => 'top_sp']) ?>
        </div>
    </section>
    
    <div class="shop-info-card">
        <div class="shop-name"><?= esc($site_settings['shop_name']) ?></div>
        <div class="shop-address"><?= esc($site_settings['shop_address']) ?></div>
        <div class="shop-tel">
            <a href="tel:<?= str_replace('-', '', $site_settings['shop_tel']) ?>">
                <span class="tel-label">TEL:</span> <?= esc($site_settings['shop_tel']) ?>
            </a>
        </div>
        <div class="shop-time">
            <span class="time-label">営業時間:</span> <?= esc($site_settings['shop_hours']) ?>
        </div>
    </div>
    <section class="rc-section">
        <!-- <h3 class="rc-title">SPECIAL CONTENTS</h3> -->
        <div class="rc-banner-wrap">
            <?= view_cell('\App\Libraries\BannerLibrary::display', ['place' => 'right_column']) ?>
        </div>
    </section>

    <section class="rc-section">
        <h3 class="rc-title">系列店一覧</h3>
        <div class="rc-banner-wrap">
            <?= view_cell('\App\Libraries\BannerLibrary::display', ['place' => 'render_shop']) ?>
        </div>
    </section>

</aside>

<style>
    .right-column {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .rc-section {
        border: 1px solid #333;
        background: rgba(255, 255, 255, 0.02);
        padding: 15px;
        border-radius: 8px;
    }

    .rc-title {
        font-size: 0.8rem;
        color: #d4af37;
        letter-spacing: 2px;
        margin: 0 0 15px 0;
        text-align: center;
        border-bottom: 1px solid #d4af37;
        padding-bottom: 8px;
    }

    .rc-banner-wrap {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    /* スマホバナーを右カラムに入れる時の調整 */
    .mobile-style {
        max-width: 280px;
        margin: 0 auto;
        border: 4px solid #222; /* スマホのベゼル風 */
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.5);
    }

    /* 共通バナー画像スタイル */
    .rc-banner-wrap img {
        width: 100%;
        height: auto;
        display: block;
        transition: 0.3s;
        border-radius: 4px;
    }
    .rc-banner-wrap img:hover {
        opacity: 0.8;
        transform: scale(1.02);
    }
</style>