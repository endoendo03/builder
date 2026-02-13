<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('content') ?>
<div class="admin-container">
    <h2>バナー一括管理</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php foreach ($settings as $key => $info): ?>
        <div class="banner-place-group" style="margin-bottom: 40px; background: #222; padding: 20px; border-radius: 8px;">
            <div class="admin-toolbar" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; border-bottom: 1px solid #444; padding-bottom: 10px;">
                <div>
                    <h3 style="margin: 0; color: #ff4444;"><?= esc($info['label']) ?></h3>
                    <small style="color: #aaa;"><?= esc($info['desc']) ?> / 最大 <?= $info['limit'] ?>枚</small>
                </div>
                
                <?php 
                $currentCount = isset($banners[$key]) ? count($banners[$key]) : 0;
                if ($currentCount < $info['limit']): 
                ?>
                    <a href="<?= site_url("admin/banner/new?place=$key") ?>" class="btn-add" style="background: #2e7d32; padding: 8px 15px; text-decoration: none; color: white; border-radius: 4px; font-size: 0.9em;">
                        + この枠に追加 (<?= $currentCount ?> / <?= $info['limit'] ?>)
                    </a>
                <?php else: ?>
                    <span style="color: #888; font-size: 0.9em;">※最大枚数に達しています</span>
                <?php endif; ?>
            </div>

            <table class="admin-table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #333;">
                        <th style="width: 60px;">順序</th>
                        <th>プレビュー</th>
                        <th>設定情報</th>
                        <th style="width: 100px;">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($banners[$key])): ?>
                        <?php foreach ($banners[$key] as $b): ?>
                            <tr style="border-bottom: 1px solid #333;">
                                <td class="text-center"><?= esc($b['sort_order']) ?></td>
                                <td>
                                    <img src="<?= base_url($b['image_path']) ?>" alt="Preview" style="max-width: <?= (strpos($key, 'sp') !== false) ? '80px' : '180px' ?>; height: auto; border: 1px solid #444;">
                                </td>
                                <td class="info-cell" style="font-size: 0.85em; line-height: 1.6;">
                                    <strong>管理タイトル:</strong> <?= esc($b['title']) ?><br>
                                    <strong>ALT:</strong> <?= esc($b['alt_text']) ?><br>
                                    <strong>リンク:</strong> <span style="color: #27ae60;"><?= esc($b['link_url'] ?: 'なし') ?></span>
                                </td>
                                <td class="text-center">
                                    <a href="<?= site_url('admin/banner/delete/' . $b['id']) ?>" 
                                       class="btn-delete" 
                                       style="color: #ff5252; font-size: 0.8em;"
                                       onclick="return confirm('削除しますか？');">
                                        削除
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 20px; color: #666;">この枠に登録されたバナーはありません。</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>