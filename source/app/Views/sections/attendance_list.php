<div class="schedule-grid">
    <?php foreach ($attendance as $c): ?>
        <?php 
            // 今日の日付を取得
            $today = date('Y-m-d');
            $startTime = '--:--';
            
            // スケジュール配列から本日の分を探す
            if (!empty($c['schedule'])) {
                foreach ($c['schedule'] as $sch) {
                    if (strpos($sch['start'], $today) === 0) {
                        $startTime = date('H:i', strtotime($sch['start']));
                        break;
                    }
                }
            }
        ?>
        
        <div class="cast-card">
            <div class="time-label">
                <span class="today-tag">本日</span> <?= $startTime ?>～
            </div>

            <?php if ($c['free_now']): ?>
                <div class="ribbon-box">
                    <span class="ribbon-text">即ヒメ</span>
                </div>
            <?php endif; ?>

            <div class="cast-img">
                <a href="<?= site_url('cast/' . $c['id']) ?>">
                    <img src="<?= esc($c['thumbnail_url']) ?>" alt="<?= esc($c['name']) ?>" loading="lazy">
                </a>
            </div>

            <div class="cast-info">
                <div class="cast-name">
                    <?= esc($c['name']) ?> (<?= esc($c['age']) ?>)
                </div>
                <div class="cast-size">
                    T<?= esc($c['height']) ?> 
                    B<?= esc($c['bust']) ?>(<?= esc($c['cup']) ?>) 
                    W<?= esc($c['waist']) ?> 
                    H<?= esc($c['hip']) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="btn-area" style="margin-top: 20px;">
    <a href="<?= site_url('schedule') ?>" class="sh-btn-gold">
        出勤情報を詳しく見る
    </a>
</div>

<style>
    /* 出勤グリッド（PCは3列、スマホは2列） */
    .schedule-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: flex-start;
    }

    .cast-card {
        width: calc(33.333% - 7px); /* PC 3列 */
        background: #f00; /* なまれんレッド */
        border: 1px solid #f00;
        position: relative;
        overflow: hidden;
        margin-bottom: 10px;
    }

    @media (max-width: 767px) {
        .cast-card {
            width: calc(50% - 5px); /* スマホ 2列 */
        }
    }

    /* 時間ラベル */
    .time-label {
        background: #fff;
        color: #000;
        font-size: 11px;
        padding: 3px 5px;
        font-weight: bold;
        text-align: center;
        border-bottom: 1px solid #f00;
    }
    .today-tag {
        background: #f00;
        color: #fff;
        padding: 0 4px;
        margin-right: 2px;
        border-radius: 2px;
    }

    /* キャスト画像 */
    .cast-img img {
        width: 100%;
        display: block;
        transition: transform 0.3s;
    }
    .cast-card:hover .cast-img img {
        transform: scale(1.05);
    }

    /* キャスト名・サイズ */
    .cast-info {
        background: #f00;
        color: #fff;
        text-align: center;
        padding: 5px 2px;
    }
    .cast-name {
        font-size: 13px;
        font-weight: bold;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .cast-size {
        background: #222; /* サイズ部分は黒背景で引き締める */
        font-size: 10px;
        padding: 3px 0;
        letter-spacing: 0.2px;
    }

    /* 即ヒメリボン（斜め配置） */
    .ribbon-box {
        position: absolute;
        top: 25px;
        right: -30px;
        background: #ff0; /* 黄色 */
        color: #000;
        padding: 2px 30px;
        transform: rotate(45deg);
        z-index: 10;
        font-weight: bold;
        font-size: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    }
</style>