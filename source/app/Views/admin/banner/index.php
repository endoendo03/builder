<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('content') ?>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<style>
    .admin-container { color: #e0e0e0; }
    /* 枠ごとのカード */
    .banner-place-group { 
        background: #2c2c2e; 
        border-radius: 12px; 
        border: 1px solid #3a3a3c;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        margin-bottom: 40px; 
        overflow: hidden;
    }
    /* ヘッダー部分 */
    .admin-toolbar { 
        padding: 20px; 
        background: rgba(255,255,255,0.03);
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        border-bottom: 1px solid #3a3a3c;
    }
    .place-label { color: #ff4444; font-size: 1.1rem; font-weight: bold; margin: 0; }
    .place-desc { color: #8e8e93; font-size: 0.8rem; margin-top: 4px; display: block; }
    
    /* 枚数制限バッジ */
    .limit-badge {
        background: #1c1c1e;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        border: 1px solid #444;
    }

    /* テーブル */
    .sh-table { width: 100%; border-collapse: collapse; }
    .sh-table th { 
        text-align: left; padding: 12px 20px; 
        background: rgba(0,0,0,0.2); color: #8e8e93; 
        font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;
    }
    .sh-table td { padding: 15px 20px; border-bottom: 1px solid #3a3a3c; vertical-align: middle; }
    .sh-table tr:last-child td { border-bottom: none; }
    .sh-table tr:hover { background: rgba(255,255,255,0.02); }

    /* ドラッグハンドル */
    .drag-handle { cursor: grab; color: #444; font-size: 1.2rem; text-align: center; }
    .drag-handle:active { cursor: grabbing; }

    /* 操作ボタン */
    .btn-add { 
        background: #2e7d32; color: white; padding: 10px 18px; 
        border-radius: 8px; font-weight: bold; text-decoration: none; 
        font-size: 0.85rem; transition: 0.2s;
    }
    .btn-add:hover { background: #388e3c; transform: translateY(-1px); }
    .btn-delete { color: #ff5252; text-decoration: none; font-size: 0.8rem; font-weight: bold; padding: 5px 10px; border-radius: 4px; }
    .btn-delete:hover { background: rgba(255,82,82,0.1); }
</style>

<div class="admin-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="margin:0;"><?= esc($title) ?></h2>
        <?php if (session()->getFlashdata('success')): ?>
            <div style="color: #4cd964; font-weight: bold;"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
    </div>

    <?php foreach ($settings as $key => $info): ?>
        <div class="banner-place-group">
            <div class="admin-toolbar">
                <div>
                    <h3 class="place-label"><?= esc($info['label']) ?></h3>
                    <span class="place-desc"><?= esc($info['desc']) ?></span>
                </div>
                
                <div style="display: flex; align-items: center; gap: 15px;">
                    <?php $currentCount = isset($banners[$key]) ? count($banners[$key]) : 0; ?>
                    <span class="limit-badge">
                        <?= $currentCount ?> / <?= $info['limit'] ?> 枚使用中
                    </span>

                    <?php if ($currentCount < $info['limit']): ?>
                        <a href="<?= site_url("admin/banner/new?place=$key") ?>" class="btn-add">
                            + 新規登録
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <table class="sh-table">
                <thead>
                    <tr>
                        <th style="width: 50px;"></th>
                        <th style="width: 200px;">プレビュー</th>
                        <th>設定詳細</th>
                        <th style="width: 100px; text-align: right;">操作</th>
                    </tr>
                </thead>
                <tbody class="sortable-list" data-place="<?= $key ?>">
                    <?php if (!empty($banners[$key])): ?>
                        <?php foreach ($banners[$key] as $b): ?>
                            <tr data-id="<?= $b['id'] ?>">
                                <td class="drag-handle">⋮⋮</td>
                                <td>
                                    <div style="position: relative; display: inline-block;">
                                        <img src="<?= base_url($b['image_path']) ?>" 
                                             style="max-width: 160px; height: auto; border-radius: 6px; border: 1px solid #444; display: block;">
                                        <?php if (strpos($key, 'sp') !== false): ?>
                                            <span style="position: absolute; bottom: 5px; right: 5px; background: rgba(0,0,0,0.7); font-size: 10px; padding: 2px 5px; border-radius: 3px;">Mobile</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight: bold; color: #fff; margin-bottom: 4px;"><?= esc($b['title']) ?></div>
                                    <div style="font-size: 0.75rem; color: #8e8e93; font-family: monospace;">
                                        ALT: <?= esc($b['alt_text'] ?: '未設定') ?><br>
                                        URL: <span style="color: #3498db;"><?= esc($b['link_url'] ?: 'なし') ?></span>
                                    </div>
                                </td>
                                <td style="text-align: right;">
                                    <a href="<?= site_url('admin/banner/delete/' . $b['id']) ?>" 
                                       class="btn-delete" 
                                       onclick="return confirm('画像を物理削除します。よろしいですか？');">
                                        削除
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 40px; color: #555; font-size: 0.9rem;">
                                登録されたバナーはありません
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 枠ごとにSortableを適用
    document.querySelectorAll('.sortable-list').forEach(el => {
        Sortable.create(el, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd: function() {
                const ids = Array.from(el.querySelectorAll('tr')).map(tr => tr.dataset.id);
                fetch('<?= site_url("admin/banner/reorder") ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ ids: ids })
                });
            }
        });
    });
});
</script>
<?= $this->endSection() ?>