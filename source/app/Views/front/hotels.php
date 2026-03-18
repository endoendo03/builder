<?= $this->extend('layouts/front_master') ?>

<?= $this->section('content') ?>
<style>
    .page-title { background: #d32f2f; color: #fff; padding: 12px 15px; font-weight: bold; text-align: center; margin-bottom: 20px; font-size: 1.2rem; }
    
    .hotel-intro { text-align: center; font-size: 13px; color: #555; margin-bottom: 25px; line-height: 1.6; padding: 0 15px; }
    
    .hotel-list { max-width: 800px; margin: 0 auto; padding: 0 15px; }
    
    .hotel-card {
        background: #fff; border: 1px solid #e0e0e0; border-radius: 8px; 
        margin-bottom: 15px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        position: relative; overflow: hidden;
    }
    
    /* 左上の斜めリボン風（ピックアップ用） */
    .pickup-ribbon {
        position: absolute; top: 0; left: 0;
        background: linear-gradient(135deg, #bf953f, #aa771c); color: #fff;
        font-size: 11px; font-weight: bold; padding: 5px 15px;
        border-radius: 0 0 8px 0; letter-spacing: 1px;
    }
    
    .hotel-name { font-size: 1.3rem; color: #333; margin: 0 0 5px 0; font-weight: bold; border-bottom: 2px solid #f9f9f9; padding-bottom: 8px; }
    .hotel-address { font-size: 12px; color: #888; margin-bottom: 15px; }
    
    .fee-box {
        display: flex; justify-content: space-between; align-items: center;
        background: #fcfcfc; border: 1px solid #f0f0f0; padding: 12px 15px; border-radius: 6px;
    }
    .fee-label { font-size: 14px; font-weight: bold; color: #555; }
    .fee-price { font-size: 1.4rem; font-weight: 900; color: #d32f2f; }
    .fee-free { color: #28a745; /* 無料の時は緑色にしてお得感アップ！ */ }

    /* スマホ向け微調整 */
    @media (max-width: 768px) {
        .hotel-card { padding: 15px; }
        .hotel-name { font-size: 1.15rem; }
        .fee-price { font-size: 1.2rem; }
    }
</style>

<div class="page-title">提携ホテル一覧</div>

<div class="hotel-intro">
    当店がご利用いただけるホテル一覧と、出張交通費のご案内です。<br>
    <span style="color: #d32f2f; font-weight: bold;">※記載のないホテル・ご自宅へもお伺い可能です！お気軽にご相談ください。</span>
</div>

<div class="hotel-list">
    <?php if (empty($hotels)): ?>
        <p style="text-align: center; color: #999; padding: 30px 0;">現在、登録されているホテルはありません。</p>
    <?php else: ?>
        <?php foreach ($hotels as $hotel): ?>
        <div class="hotel-card">
            
            <?php if ($hotel['is_pickup']): ?>
                <div class="pickup-ribbon">★ おすすめ</div>
            <?php endif; ?>
            
            <div style="margin-top: <?= $hotel['is_pickup'] ? '20px' : '0' ?>;">
                <h3 class="hotel-name"><?= esc($hotel['name']) ?></h3>
                <div class="hotel-address">
                    <i class="fas fa-map-marker-alt"></i> <?= esc($hotel['address'] ?: '住所はお問い合わせください') ?>
                </div>
                
                <div class="fee-box">
                    <span class="fee-label">交通費</span>
                    <span class="fee-price <?= $hotel['transport_fee'] == 0 ? 'fee-free' : '' ?>">
                        <?= $hotel['transport_fee'] == 0 ? '無料！' : number_format($hotel['transport_fee']) . ' 円' ?>
                    </span>
                </div>
            </div>
            
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>