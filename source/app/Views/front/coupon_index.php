<?= $this->extend('layouts/front_master') ?>

<?= $this->section('content') ?>
<style>
    .coupon-title { background: #d32f2f; padding: 10px 15px; font-weight: bold; margin-bottom: 20px; color: #fff; }
    
    /* 金色のクーポンカード */
    .coupon-card {
        background: linear-gradient(135deg, #bf953f, #fcf6ba, #b38728, #fbf5b7, #aa771c);
        color: #000;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 15px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }
    
    /* 上部：テキストと割引額の横並びエリア */
    .coupon-info-wrap {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px; /* ボタンとの間の余白 */
    }
    
    /* 左側：タイトル類 */
    .coupon-text { flex: 1; padding-right: 10px; }
    .coupon-expire { font-size: 11px; font-weight: bold; border-bottom: 1px solid rgba(0,0,0,0.2); display: inline-block; margin-bottom: 8px; }
    .coupon-name { font-size: 1.4rem; font-weight: bold; margin: 0; line-height: 1.3; }
    
    /* 右側：割引額 */
    .coupon-price { text-align: right; min-width: 90px; }
    .discount-value {
        color: #d32f2f; font-weight: 900; font-size: 2.2rem; line-height: 1;
        text-shadow: 1px 1px 0 #fff, -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff;
    }
    .discount-unit {
        color: #d32f2f; font-weight: bold; font-size: 1rem;
        text-shadow: 1px 1px 0 #fff, -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff;
    }

    /* ボタン類 */
    .use-btn {
        background: #333; color: #fff; border: none; padding: 12px 25px;
        border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 1rem;
        display: inline-block;
    }
    .use-btn:hover { background: #000; }
    .guest-msg { font-size: 12px; color: #333; font-weight: bold; margin: 0; }

    /* =======================================
       📱 スマホ用レスポンシブ対応 (768px以下)
       ======================================= */
    @media (max-width: 768px) {
        .coupon-info-wrap {
            flex-direction: column; /* 縦積みに変更 */
            align-items: flex-start; /* 左寄せ */
        }
        .coupon-text { padding-right: 0; margin-bottom: 10px; }
        .coupon-name { font-size: 1.2rem; } /* スマホではタイトルを少し小さく */
        
        .coupon-price {
            width: 100%; 
            text-align: right; /* 金額は右下に寄せる */
            border-top: 1px dashed rgba(0,0,0,0.2); /* 区切り線でオシャレに */
            padding-top: 10px;
        }
        .discount-value { font-size: 1.8rem; } /* 金額もスマホサイズに微調整 */
        
        .use-btn {
            width: 100%; /* スマホでは押しやすいようにボタンを横幅いっぱいに！ */
            text-align: center;
        }
    }
</style>

<div class="coupon-title">会員様限定クーポン</div>

<div class="coupon-list">
    <?php foreach ($coupons as $coupon): ?>
    <div class="coupon-card">
        
        <div class="coupon-info-wrap">
            <div class="coupon-text">
                <div class="coupon-expire">有効期限：<?= esc($coupon['expire_date']) ?> まで</div>
                <div class="coupon-name"><?= esc($coupon['name']) ?></div>
            </div>
            
            <div class="coupon-price">
                <?php if (!empty($coupon['discount'])): ?>
                    <div class="discount-value">
                        <?= number_format($coupon['discount']) ?>
                    </div>
                    <div class="discount-unit">
                        <?= ($coupon['discount_type'] === 'percent') ? '% OFF' : '円 OFF' ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="coupon-action">
            <?php if ($is_logged_in): ?>
                <button class="use-btn" onclick="showCouponCode('<?= esc($coupon['name']) ?>', '<?= esc($coupon['code']) ?>')">
                    クーポンを利用する
                </button>
            <?php else: ?>
                <p class="guest-msg">※ログインするとクーポンを利用できます</p>
            <?php endif; ?>
        </div>

    </div>
    <?php endforeach; ?>
</div>

<div id="codeModal" class="custom-modal-overlay" onclick="closeCodeModal()">
    <div class="modal-box light" onclick="event.stopPropagation()">
        <h3 id="modalCouponTitle" style="margin-bottom: 10px; font-weight: bold;"></h3>
        <p style="font-size: 14px; color: #666;">受付時に以下のコードをご提示ください</p>
        
        <div style="background: #f8f9fa; border: 2px dashed #333; padding: 20px; margin: 20px 0; font-size: 28px; font-weight: bold; letter-spacing: 3px; color: #d32f2f;">
            <span id="modalCouponCode"></span>
        </div>
        
        <button onclick="closeCodeModal()" class="btn-dark">閉じる</button>
    </div>
</div>

<script>
    function showCouponCode(title, code) {
        document.getElementById('modalCouponTitle').innerText = title;
        document.getElementById('modalCouponCode').innerText = code;
        // .active クラスを足して表示
        document.getElementById('codeModal').classList.add('active');
    }

    function closeCodeModal() {
        // .active クラスを外して非表示
        document.getElementById('codeModal').classList.remove('active');
    }

    // 枠外クリックで閉じる処理（既にJSファイル側にあれば不要ですが念のため）
    window.onclick = function(event) {
        if (event.target.classList.contains('custom-modal-overlay')) {
            closeCodeModal();
        }
    }
</script>
<?= $this->endSection() ?>