<div id="loginModal" class="custom-modal-overlay" onclick="closeLoginModalOutside(event)">
    <div class="modal-box light"> <div class="custom-modal-header-light">
            <h3>ログイン</h3>
            <span style="position:absolute; top:15px; right:20px; cursor:pointer; font-size:24px;" onclick="closeLoginModal()">&times;</span>
        </div>
        <div class="custom-modal-body" style="padding: 0 30px 30px;">
            <form action="<?= base_url('login/auth') ?>" method="post">
                <?= csrf_field() ?>
                <div class="custom-form-group">
                    <label style="color:#666; font-size:12px;">メールアドレス</label>
                    <input type="email" name="email" class="sh-input" style="background:#f9f9f9; border:1px solid #ddd; color:#333;" required>
                </div>
                <div class="custom-form-group">
                    <label style="color:#666; font-size:12px;">パスワード</label>
                    <input type="password" name="password" class="sh-input" style="background:#f9f9f9; border:1px solid #ddd; color:#333;" required>
                </div>
                
                <button type="submit" class="custom-submit-btn-dark">ログインする</button>
                
                <div class="modal-sub-links">
                    <a href="#">パスワードをお忘れの方</a>
                </div>
                <hr class="modal-divider">
                <button type="button" class="custom-switch-btn" onclick="switchToRegister()" onclick="openRegisterFromLogin()">新規会員登録はこちら</button>
            </form>
        </div>
    </div>
</div>
<script>
function openLoginModal() {
    const modal = document.getElementById('loginModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeLoginModal() {
    const modal = document.getElementById('loginModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

function closeLoginModalOutside(event) {
    if (event.target.id === 'loginModal') {
        closeLoginModal();
    }
}

// ログインを閉じて登録を開く
function switchToRegister() {
    closeLoginModal();
    openRegisterModal();
}
</script>