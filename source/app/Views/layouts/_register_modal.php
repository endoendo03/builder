<div id="registerModal" class="custom-modal-overlay" onclick="closeRegisterModalOutside(event)">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <h3>新規会員登録</h3>
            <button type="button" onclick="closeRegisterModal()" class="custom-close-btn">&times;</button>
        </div>

        <form id="registerForm" action="<?= base_url('register/store') ?>" method="post" class="custom-modal-body">
            <?= csrf_field() ?>
            
            <div class="custom-form-group">
                <input type="text" name="name" placeholder="ニックネーム" required>
            </div>
            
            <div class="custom-form-group">
                <input type="email" name="email" placeholder="メールアドレス" required>
            </div>
            
            <div class="custom-form-group">
                <input type="password" name="password" placeholder="パスワード" required>
            </div>

            <div class="custom-form-group">
                <label>誕生日</label>
                <input type="date" name="birthday" required>
            </div>

            <button type="submit" class="custom-submit-btn">登録する</button>
        </form>
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