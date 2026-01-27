<?= $this->extend('layouts/front_master') ?>

<?= $this->section('content') ?>
<style>
    .diary-section-title {
        background: #d32f2f;
        padding: 8px 15px;
        font-weight: bold;
        margin-bottom: 15px;
    }
    .diary-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }
    .diary-item {
        background: #111;
        border: 1px solid #333;
        text-decoration: none;
        color: #fff;
    }
    .diary-item img { width: 100%; aspect-ratio: 1/1; object-fit: cover; }
    .diary-meta { padding: 5px; font-size: 11px; }
    .diary-up { color: #ff0; font-weight: bold; }
</style>

<div class="diary-section-title">写メ日記一覧</div>

<div class="diary-grid">
    <?php foreach ($diaries as $diary): ?>
    <a href="<?= base_url('diary/detail/' . $diary['id']) ?>" class="diary-item">
        <div class="img-box" style="position: relative;">
            <img src="<?= esc($diary['image_url']) ?>" alt="<?= esc($diary['title']) ?>">
            <span class="up-badge" style="position: absolute; top: 5px; left: 5px; background: #ff0; color: #000; font-size: 10px; font-weight: bold; padding: 2px 5px;">UP</span>
        </div>
        <div class="diary-meta">
            <span style="color:#aaa; font-size: 10px;"><?= date('m/d H:i', strtotime($diary['post_dt'])) ?></span>
            <div style="font-weight:bold; margin:3px 0; color: #eee; height: 1.4em; overflow: hidden;"><?= esc($diary['title']) ?></div>
            <div style="color:#ffc107; font-size: 12px;"><?= esc($diary['girl_name']) ?>(<?= esc($diary['girl_age'] ?? '') ?>)</div>
        </div>
    </a>
    <?php endforeach; ?>
</div>

<div style="margin-top:30px; text-align:center;">
    [ 1 ] [ 2 ] [ 3 ] ...
</div>
<?= $this->endSection() ?>