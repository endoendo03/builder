<?= $this->extend('layouts/front_master') ?>

<?= $this->section('content') ?>
<style>
    /* 全体背景 */
    body { background-color: #000; color: #fff; margin: 0; font-family: sans-serif; }
    
    .schedule-grid { 
        display: flex; 
        flex-wrap: wrap; 
        gap: 4px; /* 画像の細い赤枠の間隔 */
        padding: 5px; 
    }
    
    .cast-card { 
        width: calc(33.333% - 5px); /* 3列表示 */
        background: #f00; /* 枠の色 */
        border: 1px solid #f00; 
        position: relative; 
        overflow: hidden;
    }

    /* 上部の時間帯ラベル */
    .time-label { 
        background: #fff; 
        color: #000; 
        font-size: 11px; 
        padding: 2px 4px; 
        display: flex; 
        align-items: center; 
        height: 20px;
        font-weight: bold;
    }
    .today-tag { 
        background: #f00; 
        color: #fff; 
        padding: 0 4px; 
        margin-right: 5px; 
    }
    
    /* 斜めリボン（即ヒメ） */
    .ribbon { 
        position: absolute; 
        top: 22px; 
        left: -20px; 
        background: #f00; 
        color: #fff; 
        font-size: 10px; 
        padding: 2px 20px; 
        transform: rotate(-45deg); 
        font-weight: bold; 
        border: 1px solid #fff;
        z-index: 10;
        box-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .cast-img img { 
        width: 100%; 
        display: block; 
    }

    /* 下部の名前とサイズ情報 */
    .cast-info { 
        background: #f00; 
        color: #fff;
        text-align: center;
        padding-bottom: 2px;
    }
    .cast-name { 
        font-size: 13px; 
        font-weight: bold; 
        padding: 4px 0;
    }
    .cast-size { 
        background: #222; /* サイズ部分の背景 */
        font-size: 11px; 
        padding: 3px 0; 
        letter-spacing: 0.5px;
    }

    @media (max-width: 600px) {
        /* スマホなら2列にするなど調整可。今は3列固定 */
    }
</style>
<div class="cast-section-title">本日の出勤一覧</div>

<div class="schedule-grid">
    <?php foreach ($casts as $c): ?>
        <?php 
            // 時間の整形: "2026-02-13 12:00" -> "12:00"
            $startTime = isset($c['schedule'][0]['start']) ? date('H:i', strtotime($c['schedule'][0]['start'])) : '--:--';
            $endTime   = isset($c['schedule'][0]['end'])   ? date('H:i', strtotime($c['schedule'][0]['end']))   : '--:--';
        ?>
        <div class="cast-card">
            
            <?php if ($c['free_now'] === true): ?>
                <div class="ribbon">即ヒメ</div>
            <?php endif; ?>

            <div class="cast-img">
                <img src="<?= esc($c['thumbnail_url']) ?>" alt="<?= esc($c['name']) ?>">
            </div>

            <div class="cast-info">
                <div class="time-label">
                    <span class="today-tag">本日</span> <?= $startTime ?>～<?= $endTime ?>
                </div>
                <div class="cast-name">
                    <?= esc($c['name']) ?> (<?= esc($c['age']) ?>)
                </div>
                <div class="cast-size">
                    <?= esc($c['height']) ?> 
                    <?= esc($c['bust']) ?>(<?= esc($c['cup']) ?>)/<?= esc($c['waist']) ?>/<?= esc($c['hip']) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>