<?= $this->extend('layouts/front_master') ?>

<?= $this->section('content') ?>
<div class="diary-detail-container">
    <div class="diary-section-title">
        <?= esc($diary['subject']) ?>
    </div>

    <div class="diary-post-info" style="margin-bottom: 20px; color: #aaa; font-size: 13px;">
        投稿日：<?= date('Y/m/d H:i', $diary['insert_time']) ?> | 
        投稿者：<span style="color: #ffc107; font-weight: bold;"><?= esc($diary['girl_name']) ?></span>
    </div>

    <?php if(isset($diary['imageList']) && is_array($diary['imageList'])): ?>
        <?php foreach($diary['imageList'] as $url): ?>
            <div class="diary-main-image" style="margin-bottom: 25px; text-align: center;">
                <img src="<?= esc($url) ?>" style="max-width: 100%; height: auto; border: 1px solid #444; border-radius: 5px;">
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <div class="diary-content" style="background: rgba(255,255,255,0.05); padding: 20px; border-radius: 8px; line-height: 1.8; font-size: 15px; color: #eee; white-space: pre-wrap;">
        <?= $diary['body'] ?>
    </div>

    <div style="margin-top: 40px; text-align: center;">
        <a href="<?= base_url('diary') ?>" style="display: inline-block; padding: 10px 30px; background: #333; color: #fff; text-decoration: none; border-radius: 4px; font-weight: bold;">
            一覧に戻る
        </a>
    </div>
</div>

<style>
/* 詳細画面専用の微調整があればここに（基本はstyle.css） */
.diary-detail-container {
    background: #111;
    padding: 20px;
    border: 1px solid #222;
    border-radius: 8px;
}
@media (max-width: 768px) {
    .diary-detail-container { padding: 15px; border: none; }
}
</style>
<?= $this->endSection() ?>