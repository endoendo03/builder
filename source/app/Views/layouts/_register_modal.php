<div id="registerModal" class="custom-modal-overlay" style="display: none;" onclick="closeRegisterModalOutside(event)">
    <div class="modal-box dark" onclick="event.stopPropagation()">
        <div class="custom-modal-header">
            <h3>新規会員登録</h3>
            <button class="custom-close-btn" onclick="closeRegisterModal()">&times;</button>
        </div>
        <div class="custom-modal-body">
            <form action="<?= base_url('register/store') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="custom-form-group">
                    <label class="sh-label">お名前</label>
                    <input type="username" name="username" class="sh-input" placeholder="" required>
                </div>
                
                <div class="custom-form-group">
                    <label class="sh-label">メールアドレス</label>
                    <input type="email" name="email" class="sh-input" placeholder="example@mail.com" required>
                </div>
                
                <div class="custom-form-group">
                    <label class="sh-label">パスワード</label>
                    <input type="password" name="password" class="sh-input" placeholder="8文字以上" required>
                </div>

                <div class="custom-form-group">
                    <label class="sh-label">生年月日</label>
                    <input type="date" name="birthday" class="sh-input" required 
                           max="<?= date('Y-m-d', strtotime('-18 years')) ?>">
                </div>

                <button type="submit" class="custom-submit-btn">規約に同意して登録</button>
            </form>
        </div>
    </div>
</div>