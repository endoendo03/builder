<div id="registerModal" class="custom-modal-overlay" onclick="closeRegisterModalOutside(event)">
    <div class="modal-box dark"> <div class="custom-modal-header">
            <h3>新規会員登録</h3>
            <button class="custom-close-btn" onclick="closeRegisterModal()">&times;</button>
        </div>
        <div class="custom-modal-body">
            <form action="<?= base_url('register/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="custom-form-group">
                    <label class="sh-label">メールアドレス</label>
                    <input type="email" name="email" class="sh-input" required>
                </div>
                <div class="custom-form-group">
                    <label class="sh-label">パスワード</label>
                    <input type="password" name="password" class="sh-input" required>
                </div>
                <button type="submit" class="custom-submit-btn">規約に同意して登録</button>
            </form>
        </div>
    </div>
</div>
<script>
// モーダルを開く
function openRegisterModal() {
    const modal = document.getElementById('registerModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden'; // 背後のスクロールを止める
}

// モーダルを閉じる
function closeRegisterModal() {
    const modal = document.getElementById('registerModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto'; // スクロールを再開
}

// 枠外クリックで閉じる
function closeRegisterModalOutside(event) {
    if (event.target.id === 'registerModal') {
        closeRegisterModal();
    }
}
</script>