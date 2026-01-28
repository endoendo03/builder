<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('content') ?>
<div class="admin-container">
    <h2>TOPバナー管理</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="admin-toolbar" style="margin-bottom: 20px;">
        <p>現在の登録数: <strong><?= count($banners) ?> / 5</strong></p>
        
        <?php if (count($banners) < 5): ?>
            <a href="<?= site_url('admin/banner/top_new') ?>" class="btn-add">+ 新規バナーを追加</a>
        <?php else: ?>
            <span class="text-muted">※最大枚数に達しているため、追加するには既存のものを削除してください。</span>
        <?php endif; ?>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 80px;">順序</th>
                <th>PCバナー (1920px〜)</th>
                <th>SPバナー (〜768px)</th>
                <th>設定情報</th>
                <th style="width: 120px;">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($banners)): ?>
                <?php foreach ($banners as $b): ?>
                    <tr>
                        <td class="text-center"><?= esc($b['sort_order']) ?></td>
                        <td>
                            <img src="<?= base_url($b['pc_image_path']) ?>" alt="PC Preview" style="max-width: 200px; height: auto; border: 1px solid #444;">
                        </td>
                        <td>
                            <img src="<?= base_url($b['sp_image_path']) ?>" alt="SP Preview" style="max-width: 100px; height: auto; border: 1px solid #444;">
                        </td>
                        <td class="info-cell">
                            <strong>管理タイトル:</strong> <?= esc($b['title']) ?><br>
                            <strong>ALTテキスト:</strong> <?= esc($b['alt_text']) ?><br>
                            <strong>リンク先:</strong> <a href="<?= esc($b['link_url']) ?>" target="_blank"><?= esc($b['link_url']) ?></a>
                        </td>
                        <td class="text-center">
                            <a href="<?= site_url('admin/banner/top_delete/' . $b['id']) ?>" 
                               class="btn-delete" 
                               onclick="return confirm('このバナーを削除してもよろしいですか？\nサーバー上の画像ファイルも完全に削除されます。');">
                               削除
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 50px;">バナーが登録されていません。</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>