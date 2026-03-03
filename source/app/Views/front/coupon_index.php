<?= $this->extend('layouts/front_master') ?>

<?= $this->section('content') ?>
<style>
    .coupon-title { background: #d32f2f; padding: 10px 15px; font-weight: bold; margin-bottom: 20px; }
    
    /* 金色のクーポンカード */
    .coupon-card {
        background: linear-gradient(135deg, #bf953f, #fcf6ba, #b38728, #fbf5b7, #aa771c);
        color: #000;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 15px;
        position: relative;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }
    .coupon-expire { font-size: 11px; font-weight: bold; border-bottom: 1px solid rgba(0,0,0,0.2); display: inline-block; margin-bottom: 5px; }
    .coupon-name { font-size: 1.4rem; font-weight: bold; margin: 10px 0; }
    
    /* ボタン */
    .use-btn {
        background: #333; color: #fff; border: none; padding: 10px 25px;
        border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 0.9rem;
    }
    .use-btn:hover { background: #000; }
    
    .guest-msg { font-size: 12px; color: #333; font-weight: bold; }
</style>

<div class="coupon-title">会員様限定クーポン</div>

<div class="coupon-list">
    <?php foreach ($coupons as $coupon): ?>
    <div class="coupon-card">
        <div class="coupon-expire">有効期限：<?= esc($coupon['expire_date']) ?> まで</div>
        <div class="coupon-name"><?= esc($coupon['name']) ?></div>
        
        <?php if ($is_logged_in): ?>
            <button class="use-btn" onclick="showCouponCode('<?= esc($coupon['name']) ?>', '<?= esc($coupon['code']) ?>')">
                クーポンを利用する
            </button>
        <?php else: ?>
            <p class="guest-msg">※ログインするとクーポンを利用できます</p>
        <?php endif; ?>
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