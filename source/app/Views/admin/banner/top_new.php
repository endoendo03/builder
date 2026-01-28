<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('content') ?>
<div class="admin-container">
    <h2>TOPバナー新規登録</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('admin/banner/top_store') ?>" method="post" enctype="multipart/form-data" class="admin-form">
        <?= csrf_field() ?>

        <div class="form-group">
            <label>管理タイトル</label>
            <input type="text" name="title" value="<?= old('title') ?>" placeholder="例：2024夏キャンペーン" required>
        </div>

        <div class="form-group">
            <label>画像の説明（ALT属性）</label>
            <input type="text" name="alt_text" value="<?= old('alt_text') ?>" placeholder="例：新人人妻キャスト多数在籍！" required>
            <small>※SEO用。画像が表示されない場合や読み上げソフトで使われます。</small>
        </div>

        <div class="form-group">
            <label>PC用バナー (推奨: 1920x600px / 2MBまで)</label>
            <input type="file" name="pc_image" accept="image/*" required>
        </div>

        <div class="form-group">
            <label>スマホ用バナー (推奨: 800x800px / 2MBまで)</label>
            <input type="file" name="sp_image" accept="image/*" required>
        </div>

        <div class="form-group">
            <label>リンク先URL (任意)</label>
            <input type="text" name="link_url" value="<?= old('link_url') ?>" placeholder="https://...">
        </div>

        <div class="form-group">
            <label>表示順 (数字が小さいほど先頭)</label>
            <input type="number" name="sort_order" value="<?= old('sort_order', 0) ?>">
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-submit">保存する</button>
            <a href="<?= site_url('admin/banner/top_index') ?>" class="btn-cancel">戻る</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>