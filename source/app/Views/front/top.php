<?= $this->extend('layouts/frontend_master') ?>

<?= $this->section('content') ?>
<section class="main-visual">
    <?= view_cell('\App\Libraries\BannerLibrary::display', ['place' => 'top_pc']) ?>
</section>

<div class="top-container">
    
    <section class="info-section">
        <h2 class="top-title">INFORMATION</h2>
        <div class="info-list">
            <p>2026.02.27：本日の出勤情報を更新しました。</p>
        </div>
    </section>

    <section class="schedule-section">
        <h2 class="top-title">TODAY'S CAST</h2>
        <div class="schedule-grid">
            <?php foreach ($casts as $c): ?>
                <?php 
                    $startTime = isset($c['schedule'][0]['start']) ? date('H:i', strtotime($c['schedule'][0]['start'])) : '--:--';
                ?>
                <div class="cast-card">
                    <div class="time-label"><span class="today-tag">本日</span> <?= $startTime ?>～</div>
                    <?php if ($c['free_now']): ?><div class="ribbon">即ヒメ</div><?php endif; ?>
                    <div class="cast-img"><img src="<?= esc($c['thumbnail_url']) ?>" alt=""></div>
                    <div class="cast-info">
                        <div class="cast-name"><?= esc($c['name']) ?> (<?= esc($c['age']) ?>)</div>
                        <div class="cast-size"><?= esc($c['height']) ?> <?= esc($c['bust']) ?>(<?= esc($c['cup']) ?>)/<?= esc($c['waist']) ?>/<?= esc($c['hip']) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="btn-area">
            <a href="<?= site_url('schedule') ?>" class="sh-btn-gold">出勤情報を詳しく見る</a>
        </div>
    </section>

    <?php if (isset($activeSurvey)): ?>
    <section class="survey-section">
        <div class="survey-banner">
            <h3><?= esc($activeSurvey['title']) ?></h3>
            <p>お客様の声をお聞かせください。抽選で特典をプレゼント！</p>
            <a href="<?= url_to('Survey::show', $activeSurvey['id']) ?>" class="sh-btn-white">アンケートに回答する</a>
        </div>
    </section>
    <?php endif; ?>

</div>

<style>
    /* なまれん風ベースデザイン */
    body { background-color: #000; color: #fff; margin: 0; }
    .top-container { max-width: 1000px; margin: 0 auto; padding: 20px 10px; }
    
    .top-title { 
        text-align: center; font-size: 1.5rem; letter-spacing: 3px; 
        border-bottom: 1px solid #d4af37; /* 金色 */
        padding-bottom: 10px; margin-bottom: 30px; color: #d4af37;
    }

    /* 出勤ボード（3列） */
    .schedule-grid { display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; }
    .cast-card { width: calc(33.333% - 8px); background: #f00; border: 1px solid #f00; position: relative; }
    .time-label { background: #fff; color: #000; font-size: 11px; padding: 2px 4px; font-weight: bold; }
    .cast-img img { width: 100%; display: block; }
    .cast-info { background: #f00; text-align: center; padding-bottom: 5px; }
    .cast-name { font-size: 13px; font-weight: bold; }
    .cast-size { background: #222; font-size: 10px; padding: 2px 0; }

    /* 金色ボタン */
    .sh-btn-gold { 
        display: block; width: 250px; margin: 30px auto; padding: 15px;
        border: 1px solid #d4af37; color: #d4af37; text-decoration: none;
        text-align: center; font-weight: bold; transition: 0.3s;
    }
    .sh-btn-gold:hover { background: #d4af37; color: #000; }

    /* アンケートバナー */
    .survey-section { margin-top: 50px; }
    .survey-banner { 
        background: linear-gradient(135deg, #2c3e50, #000); 
        border: 2px solid #3498db; padding: 30px; border-radius: 15px; text-align: center;
    }
    .sh-btn-white { 
        display: inline-block; padding: 10px 30px; background: #fff; 
        color: #2c3e50; text-decoration: none; border-radius: 30px; font-weight: bold;
    }
</style>
<?= $this->endSection() ?>