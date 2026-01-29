<?= $this->extend('layouts/front_master') ?>

<?= $this->section('content') ?>
<div class="detail-container">
    <div class="detail-header">
        <h1><?= esc($cast['name']) ?>(<?= esc($cast['age']) ?>歳)</h1>
        <p class="header-spec">
            T<?= esc($cast['height']) ?> B<?= esc($cast['bust']) ?>(<?= esc($cast['cup']) ?>) W<?= esc($cast['waist']) ?> H<?= esc($cast['hip']) ?>
        </p>
        <!-- <span class="tag">#熟女系</span> -->
    </div>

    <div class="main-layout">
        <div class="image-section">
            <img src="<?= $cast['thumbnail_url'] ?>" class="main-photo">
            </div>

        <div class="info-section">
            <!-- <div class="status-bar">受付終了</div> -->
            <table class="profile-table">
                <tr><th>名前</th><td><?= esc($cast['name']) ?> (<?= esc($cast['age']) ?>歳)</td></tr>
                <tr><th>サイズ</th><td>T<?= esc($cast['height']) ?> B<?= esc($cast['bust']) ?>(<?= esc($cast['cup']) ?>) W<?= esc($cast['waist']) ?> H<?= esc($cast['hip']) ?></td></tr>
                <tr><th>血液型</th><td><?= esc($cast['blood_type'] ?? '') ?></td></tr>
                <tr><th>喫煙</th><td><?= esc($cast['smoking'] ?? '') ?></td></tr>
                <tr><th>お酒</th><td><?= esc($cast['drink'] ?? '') ?></td></tr>
                <tr><th>得意技</th><td class="highlight"><?= esc($cast['skill'] ?? 'フェラが得意です！') ?></td></tr>
                <tr><th>性感帯</th><td><?= esc($cast['erogenous_zone'] ?? 'クリが敏感です・・・') ?></td></tr>
                <tr><th>コメント</th><td class="play-list"><?= nl2br($cast['girl_comment'] ?? '') ?></td></tr>
            </table>
        </div>
    </div>
</div>

<style>
    .detail-container { background: #000; color: #fff; padding: 15px; min-height: 100vh; }
    
    /* ヘッダー */
    .detail-header { border-left: 5px solid #ff4444; padding-left: 15px; margin-bottom: 20px; }
    .detail-header h1 { font-size: 20px; margin: 0; }
    .header-spec { color: #ccc; margin: 5px 0; font-size: 14px; }
    .tag { background: #f57c00; font-size: 11px; padding: 2px 8px; border-radius: 10px; }

    /* レイアウト */
    .main-layout { display: flex; flex-direction: column; gap: 20px; }
    @media (min-width: 768px) { .main-layout { flex-direction: row; } }

    /* 画像 */
    .image-section { flex: 1; }
    .main-photo { width: 100%; border-radius: 5px; box-shadow: 0 0 15px rgba(255,255,255,0.1); }

    /* プロフィール表 */
    .info-section { flex: 1.5; }
    .status-bar { background: #ccaa00; color: #000; font-weight: bold; padding: 5px; text-align: center; margin-bottom: 1px; }
    
    .profile-table { width: 100%; border-collapse: collapse; font-size: 14px; }
    .profile-table th { background: #222; width: 30%; padding: 10px; text-align: left; border: 1px solid #333; color: #aaa; }
    .profile-table td { background: #fff; color: #333; padding: 10px; border: 1px solid #ccc; }
    
    .highlight { color: #d32f2f; font-weight: bold; }
    .play-list { font-size: 12px; line-height: 1.6; color: #444; }
</style>

<?= $this->endSection() ?>