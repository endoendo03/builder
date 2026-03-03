<?= $this->extend('layouts/front_master') ?>
<?= $this->section('content') ?>

<div style="max-width: 400px; margin: 50px auto; background: #fff; padding: 40px; border-radius: 8px; color: #333; text-align: center;">
    <h2 style="margin-bottom: 20px;">パスワード再設定</h2>
    <p style="font-size: 13px; color: #666; margin-bottom: 20px;">新しいパスワードを入力してください。</p>

    <form action="<?= base_url('password/update') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="token" value="<?= esc($token) ?>">
        
        <input type="password" name="password" placeholder="新しいパスワード" 
               style="width:100%; padding:12px; border:1px solid #ddd; border-radius:4px; margin-bottom:20px;" required>
        
        <button type="submit" class="btn-dark" style="width:100%; padding:15px; background:#333; color:#fff; border:none; border-radius:4px; font-weight:bold; cursor:pointer;">
            パスワードを更新する
        </button>
    </form>
</div>

<?= $this->endSection() ?>