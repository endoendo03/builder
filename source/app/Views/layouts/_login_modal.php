<div id="loginModal" class="custom-modal-overlay" onclick="closeLoginModalOutside(event)">
    <div class="custom-modal-content login-style-white">
        <div class="custom-modal-header-light">
            <h3>ログイン</h3>
        </div>

        <form id="loginForm" action="<?= base_url('login/auth') ?>" method="post" class="custom-modal-body">
            <?= csrf_field() ?>
            
            <div class="custom-form-group">
                <input type="email" name="email" placeholder="メールアドレスを入力してください" required class="input-light">
            </div>
            
            <div class="custom-form-group">
                <input type="password" name="password" placeholder="パスワードを入力してください" required class="input-light">
            </div>

            <button type="submit" class="custom-submit-btn-dark">ログイン</button>

            <div class="modal-sub-links">
                <a href="#">パスワードを忘れた方はこちら</a>
            </div>

            <hr class="modal-divider">

            <button type="button" onclick="switchToRegister()" class="custom-switch-btn">新規会員登録</button>
        </form>
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