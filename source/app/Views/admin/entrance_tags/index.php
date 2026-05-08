<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('content') ?>
<div class="admin-page-header">
    <h2>年齢認証ページ（スプラッシュ）のバナー管理</h2>
</div>

<div class="admin-card">
    <p style="color: #666; margin-bottom: 20px;">
        サイトに入る前の「年齢認証画面」に表示したい集客媒体バナー（ぴゅあ等）のタグを貼り付けてください。<br>
        <strong>※ここの設定はトップページや下層ページには影響しません。</strong>
    </p>

    <form action="<?= base_url('admin/entrance_tags/update') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group" style="margin-bottom: 30px;">
            <label style="display:block; font-weight:bold; margin-bottom:10px;">
                <i class="fa-solid fa-image"></i> バナー用タグ（footer_tags枠を使用）
            </label>
            <p style="font-size:12px; color:#999; margin-bottom:5px;">用途：年齢確認ボタンの下に表示される広告バナー等</p>
            <textarea name="footer_tags" style="width:100%; height:150px; font-family:monospace; padding:10px; border:1px solid #ccc; border-radius:4px;"><?= esc($setting['footer_tags']) ?></textarea>
        </div>
        
        <input type="hidden" name="header_tags" value="<?= esc($setting['header_tags']) ?>">

        <button type="submit" class="btn-cyan" style="padding: 12px 30px; font-size: 16px;">
            <i class="fa-solid fa-save"></i> バナーを保存する
        </button>
    </form>
</div>
<?= $this->endSection() ?>