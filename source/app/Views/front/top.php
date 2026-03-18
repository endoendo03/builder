<?= $this->extend('layouts/front_master') ?>

<?= $this->section('content') ?>

<div class="main-wrapper">
    <div class="top-container">
        <div>
            <img style="width: 100%;" src="/images/top_mov.gif" alt="ドスケベ奥様、濡れ待ち中！">
        </div>
        <div class="pc" style="position: relative;">
            <img src="/images/top_main-title.png" class="u-hidden-sp" alt="仙台デリヘル「人妻生レンタル-仙台名物-」">
            <img style="width: 100%;" src="/images/top_main.jpg" alt="他人の妻がホテルやご自宅に入るなり、即チ◯ポを欲しがる姿を。「硬くて大きいのが欲しいの！」「すごく美味しいのぉ〜」とエロイ言葉を発する奥様の膣穴から、クチュクチュと垂れるマン汁・・・そして、姉妻レンタル始動！！ルックス＆スタイルは勿論の事、礼儀正しい女の子のご案内も可能です！！">
        </div>
        <?php if (!empty($attendance)): ?>
            <section class="top-section attendance-area">
                <h2 class="section-title">TODAY'S CAST<span>本日の出勤</span></h2>
                <div class="section-body">
                    <?= view('sections/attendance_list', ['list' => $attendance]) ?>
                </div>
            </section>
        <?php endif; ?>
        <?php if (!empty($top_free_space)): ?>
            <div class="free-space-container" style="padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 30px;">
                
                <?= $top_free_space ?>
                
            </div>
        <?php endif; ?>
        <?php if (!empty($exp_videos)): ?>
            <section class="top-section">
                <h2 class="top-title">EXPERIENCE MOVIE<span>体験動画</span></h2>
                <?= view('sections/experience_video', ['exp_videos' => $exp_videos]) ?>
            </section>
        <?php endif; ?>
        
        <?php if (!empty($raw_videos)): ?>
            <section class="top-section">
                <h2 class="top-title">MOVIE<span>生動画</span></h2>
                <?= view('sections/raw_video_list', ['displayVideos' => $raw_videos]) ?>
            </section>
        <?php endif; ?>

        <?php if (!empty($exp_comic)): ?>
            <section class="top-section">
                <h2 class="top-title">EXPERIENCE COMIC<span>体験漫画</span></h2>
                <?= view('sections/experience_comic', ['exp_comic' => $exp_comic]) ?>
            </section>
        <?php endif; ?>

    </div>
</div>

<style>
    /* -----------------------------------------
       1. フルワイドバナー (main-visual)
    ----------------------------------------- */
    .main-visual .sh-banner-pc { display: block; }
    .main-visual .sh-banner-sp { display: none; }

    @media (max-width: 767px) {
        .main-visual .sh-banner-pc { display: none !important; }
        .main-visual .sh-banner-sp { display: block !important; }
    }

    /* サイドバーにあるスマホバナーは常に表示する */
    .side-content .sh-banner-sp {
        display: block !important;
    }

    .main-visual {
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        overflow: hidden;
        border-bottom: 2px solid #d4af37; /* 金の境界線 */
    }

    .swiper-container { width: 100%; }
    .swiper-slide img { width: 100%; height: auto; display: block; }

    /* -----------------------------------------
       2. 背景画像の設定 (main-wrapper)
    ----------------------------------------- */
    .main-wrapper {
        width: 100%;
        /* 元のHTMLにあった背景設定を反映 */
        background-image: url('https://namaren-sendai.com/assets/front/img/top/bg_pc.jpg');
        background-repeat: repeat-y;
        background-size: 100% auto;
        background-position: top center;
        background-attachment: scroll;
        padding-bottom: 60px;
    }

    /* -----------------------------------------
       3. コンテンツエリア
    ----------------------------------------- */
    .top-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 40px 10px;
        /* 背景画像の上にうっすら黒を載せて文字を読みやすくする場合 */
        /* background: rgba(0, 0, 0, 0.4); */
    }

    .top-title { 
        text-align: center; font-size: 1.5rem; letter-spacing: 3px; 
        border-bottom: 1px solid #d4af37;
        padding-bottom: 15px; margin-bottom: 40px; color: #d4af37;
        font-family: "serif"; /* 和風っぽく */
    }

    /* 出勤ボード */
    .schedule-grid { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; }
    
    /* PC: 3列 / スマホ: 2列 */
    .cast-card { 
        width: calc(33.333% - 10px); 
        background: #f00; 
        border: 1px solid #f00; 
        position: relative; 
        margin-bottom: 10px;
    }
    
    @media (max-width: 767px) {
        .cast-card { width: calc(50% - 10px); }
    }

    .time-label { background: #fff; color: #000; font-size: 11px; padding: 4px; font-weight: bold; text-align: center; }
    .today-tag { background: #f00; color: #fff; padding: 0 4px; margin-right: 4px; }
    .cast-img img { width: 100%; display: block; }
    .cast-info { background: #f00; text-align: center; padding: 5px 0; }
    .cast-name { font-size: 14px; font-weight: bold; }
    .cast-size { background: #222; font-size: 11px; padding: 3px 0; letter-spacing: 0.5px; }

    /* 金色ボタン */
    .sh-btn-gold { 
        display: block; width: 280px; margin: 40px auto; padding: 18px;
        border: 1px solid #d4af37; color: #d4af37; text-decoration: none;
        text-align: center; font-weight: bold; transition: 0.3s;
        background: rgba(0,0,0,0.6);
    }
    .sh-btn-gold:hover { background: #d4af37; color: #000; }

    /* アンケート */
    .survey-banner { 
        background: linear-gradient(135deg, rgba(44,62,80,0.9), rgba(0,0,0,0.9)); 
        border: 2px solid #3498db; padding: 40px; border-radius: 15px; text-align: center;
    }
    .sh-btn-white { 
        display: inline-block; padding: 12px 40px; background: #fff; 
        color: #2c3e50; text-decoration: none; border-radius: 30px; font-weight: bold; margin-top: 15px;
    }

    body { overflow-x: hidden; background-color: #000; }
</style>

<?= $this->endSection() ?>