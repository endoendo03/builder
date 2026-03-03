<div id="loginModal" class="custom-modal-overlay" style="display: none;" onclick="closeLoginModalOutside(event)">
    <div class="modal-box light" onclick="event.stopPropagation()">
        <div class="modal-header-simple">
            <h3>ログイン</h3>
            <span class="close-btn" onclick="closeLoginModal()">&times;</span>
        </div>

        <form action="<?= base_url('login/auth') ?>" method="post">
            <?= csrf_field() ?>
            <div class="input-group">
                <label style="color:#666; font-size:12px; display:block; text-align:left;">メールアドレス</label>
                <input type="email" name="email" placeholder="example@mail.com" class="minimal-input" required>
            </div>
            <div class="input-group" style="margin-top:10px;">
                <label style="color:#666; font-size:12px; display:block; text-align:left;">パスワード</label>
                <input type="password" name="password" placeholder="••••••••" class="minimal-input" required>
            </div>

            <div class="forgot-password" style="text-align:right; margin: 10px 0 20px;">
                <a href="<?= base_url('forgot-password') ?>" style="font-size:0.8rem; color:#888;">パスワードを忘れた方はこちら</a>
            </div>

            <button type="submit" class="btn-dark">ログイン</button>
        </form>

        <hr class="modal-divider" style="border:0; border-top:1px solid #eee; margin:25px 0;">

        <div class="register-info">
            <p style="color:#666; font-size:0.85rem; margin-bottom:10px;">アカウントをお持ちでないですか？</p>
            <button type="button" class="btn-outline" onclick="openRegisterFromLogin()">新規会員登録はこちら</button>
        </div>
    </div>
</div>

<style>
/* モーダル内のヘッダー調整 */
.modal-header-simple {
    position: relative;
    margin-bottom: 25px;
}
.modal-header-simple h3 {
    margin: 0; font-size: 1.4rem; font-weight: bold; color: #333;
}
.close-btn {
    position: absolute; right: -10px; top: -10px;
    font-size: 28px; cursor: pointer; color: #999;
}

/* 入力グループ */
.input-group { text-align: left; margin-bottom: 15px; }
.input-group label {
    display: block; font-size: 0.75rem; color: #666; margin-bottom: 5px; font-weight: bold;
}

/* パスワードを忘れた方リンク */
.forgot-password { text-align: right; margin-bottom: 20px; }
.forgot-password a { font-size: 0.8rem; color: #888; text-decoration: underline; }
.forgot-password a:hover { color: #333; }

/* 区切り線 */
.modal-divider { border: 0; border-top: 1px solid #eee; margin: 25px 0; }

/* 新規登録セクション */
.register-info p { font-size: 0.85rem; color: #666; margin-bottom: 10px; }
.btn-outline {
    width: 100%; padding: 12px;
    background: #fff; border: 1px solid #333; color: #333;
    border-radius: 4px; font-weight: bold; cursor: pointer;
    transition: 0.2s;
}
.btn-outline:hover { background: #f5f5f5; border-color: #000; }

/* 既存のボタン微調整 */
.btn-dark {
    width: 100%; padding: 15px; background: #333; color: #fff;
    border: none; border-radius: 4px; font-weight: bold; font-size: 1rem; cursor: pointer;
}
.btn-dark:hover { background: #000; }
</style>