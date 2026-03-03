<div id="loginModal" class="modal-overlay">
    <div class="modal-card white">
        <h3>ログイン</h3>
        <form action="<?= base_url('login/auth') ?>" method="post">
            <input type="email" name="email" placeholder="メールアドレス" class="minimal-input">
            <input type="password" name="password" placeholder="パスワード" class="minimal-input">
            <button type="submit" class="btn-dark">ログイン</button>
        </form>
    </div>
</div>

<style>
/* 複雑なクラス名を排除して、シンプルに。 */
.modal-overlay {
    position: fixed; inset: 0; background: rgba(0,0,0,0.8);
    display: none; justify-content: center; align-items: center; z-index: 10000;
}
.modal-card {
    width: 90%; max-width: 380px; padding: 30px; border-radius: 8px;
}
.modal-card.white { background: #fff; color: #333; text-align: center; }

.minimal-input {
    width: 100%; padding: 12px; margin-bottom: 10px;
    border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;
}
.btn-dark {
    width: 100%; padding: 14px; background: #333; color: #fff; border: none; border-radius: 4px; cursor: pointer;
}
</style>