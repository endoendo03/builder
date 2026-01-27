<?= $this->extend('layouts/front_master') ?>

<?= $this->section('content') ?>
<div class="cast-section-title">キャスト一覧</div>

<div class="cast-grid">
    <?php if (!empty($casts)): ?>
        <?php foreach ($casts as $cast): ?>
        <a href="<?= base_url('cast/detail/' . $cast['id']) ?>" class="cast-card">
            <div class="cast-img">
                <img src="<?= $cast['image_url'] ?: '/images/common/no_image.jpg' ?>" alt="<?= esc($cast['name']) ?>">
                
                <?php if (!empty($cast['is_new'])): ?>
                    <span class="cast-label new">NEW</span>
                <?php endif; ?>
            </div>
            
            <div class="cast-info">
                <span class="cast-name"><?= esc($cast['name']) ?></span>
                <span class="cast-age">(<?= esc($cast['age']) ?>)</span>
                
                <div class="cast-size">
                    T<?= esc($cast['height']) ?> B<?= esc($cast['bust']) ?>(<?= esc($cast['cup']) ?>) W<?= esc($cast['waist']) ?> H<?= esc($cast['hip']) ?>
                </div>
                
                <div class="cast-status">
                    <span class="status-badge">本日出勤</span>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center; padding: 50px 0;">ただいま準備中です。</p>
    <?php endif; ?>
</div>

<style>
/* キャスト一覧専用のスタイル（style.cssにまとめてもOK） */
.cast-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 15px;
}

.cast-card {
    background: #111;
    border: 1px solid #333;
    text-decoration: none;
    color: #fff;
    transition: transform 0.2s;
}

.cast-card:hover {
    transform: translateY(-5px);
    border-color: #d32f2f;
}

.cast-img {
    position: relative;
    width: 100%;
    aspect-ratio: 3/4; /* 縦長写真に対応 */
    overflow: hidden;
}

.cast-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.cast-label.new {
    position: absolute;
    top: 5px;
    right: 5px;
    background: #ff0000;
    color: #fff;
    font-size: 10px;
    padding: 2px 6px;
    font-weight: bold;
}

.cast-info {
    padding: 10px;
    text-align: center;
}

.cast-name {
    font-size: 16px;
    font-weight: bold;
    color: #ffc107;
}

.cast-age {
    font-size: 12px;
    color: #aaa;
}

.cast-size {
    font-size: 11px;
    color: #ccc;
    margin-top: 5px;
}

.cast-status {
    margin-top: 8px;
}

.status-badge {
    display: inline-block;
    background: #d32f2f;
    font-size: 10px;
    padding: 2px 8px;
    border-radius: 10px;
}

/* スマホ対応：2列にする */
@media (max-width: 480px) {
    .cast-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
    }
}
</style>
<?= $this->endSection() ?>