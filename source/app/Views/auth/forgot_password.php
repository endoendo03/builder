<?= $this->extend('layouts/front_master') ?>
<?= $this->section('content') ?>

<div style="max-width: 450px; margin: 60px auto; background: #fff; padding: 40px; border-radius: 12px; color: #333; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.2);">
    <h2 style="margin-bottom: 15px; font-weight: bold;">パスワードの再設定</h2>
    <p style="font-size: 14px; color: #666; margin-bottom: 25px; line-height: 1.6;">
        ご登録済みのメールアドレスを入力してください。<br>
        パスワード再設定用のURLをお送りします（開発中は画面上部に出ます）。
    </p>

    <form action="<?= base_url('forgot-password') ?>" method="post">
        <?= csrf_field() ?>
        
        <div style="text-align: left; margin-bottom: 20px;">
            <label style="font-size: 12px; font-weight: bold; color: #333;">メールアドレス</label>
            <input type="email" name="email" placeholder="example@mail.com" required
                   style="width:100%; padding:14px; border:1px solid #ddd; border-radius:6px; margin-top:5px; font-size: 16px;">
        </div>
        
        <button type="submit" class="btn-dark" style="width:100%; padding:16px; background:#333; color:#fff; border:none; border-radius:6px; font-weight:bold; font-size: 1rem; cursor:pointer; transition: 0.3s;">
            リセットURLを発行する
        </div>
    </form>

    <div style="margin-top: 25px;">
        <a href="<?= base_url('/') ?>" style="color: #888; font-size: 13px; text-decoration: underline;">
            トップページに戻る
        </a>
    </div>
</div>

<?= $this->endSection() ?>