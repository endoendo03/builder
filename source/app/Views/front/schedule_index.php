<?= $this->extend('layouts/front_master') ?>

<?= $this->section('content') ?>
<style>
    .schedule-grid { display: flex; flex-wrap: wrap; gap: 10px; background: #000; padding: 10px; }
    .cast-card { width: calc(33.333% - 10px); background: #f00; border: 2px solid #f00; position: relative; color: #fff; text-align: center; }
    
    /* 上部の時間帯ラベル */
    .time-label { background: #fff; color: #000; font-size: 0.8rem; padding: 2px 5px; display: flex; align-items: center; }
    .today-tag { background: #f00; color: #fff; padding: 2px 5px; margin-right: 5px; font-weight: bold; }
    
    /* 斜めリボン（即ヒメなど） */
    .ribbon { position: absolute; top: 25px; left: -5px; background: #f00; color: #fff; font-size: 0.6rem; 
               padding: 2px 15px; transform: rotate(-45deg); font-weight: bold; border: 1px solid #fff; }

    .cast-img img { width: 100%; display: block; border-bottom: 5px solid #f00; }
    .cast-info { padding: 5px 0; }
    .cast-name { font-size: 1.1rem; font-weight: bold; }
    .cast-size { background: #333; font-size: 0.8rem; padding: 3px 0; letter-spacing: 1px; }
</style>
<div class="cast-section-title">本日の出勤一覧</div>

<div class="schedule-grid">
    <?php foreach ($casts as $c): ?>
    <div class="cast-card">
        <div class="time-label">
            <span class="today-tag">本日</span> <?= esc($c['work_time']) ?>
        </div>
        
        <?php if (!empty($c['label'])): ?>
            <div class="ribbon"><?= esc($c['label']) ?></div>
        <?php endif; ?>

        <div class="cast-img">
            <img src="<?= esc($c['photo_url']) ?>" alt="<?= esc($c['name']) ?>">
        </div>

        <div class="cast-info">
            <div class="cast-name"><?= esc($c['name']) ?> (<?= esc($c['age']) ?>)</div>
            <div class="cast-size">
                <?= esc($c['height']) ?> 
                <?= esc($c['bust']) ?>(<?= esc($c['cup']) ?>)/<?= esc($c['waist']) ?>/<?= esc($c['hip']) ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>