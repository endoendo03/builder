<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('content') ?>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<style>
    /* 全体のコンテナ */
    .survey-card { background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); overflow: hidden; margin-top: 20px; }
    
    /* シュッとしたテーブル */
    .sh-table { width: 100%; border-collapse: collapse; }
    .sh-table th { background: #f8f9fa; color: #7f8c8d; font-size: 0.85rem; text-transform: uppercase; padding: 15px; border-bottom: 2px solid #edf2f7; }
    .sh-table td { padding: 15px; border-bottom: 1px solid #edf2f7; vertical-align: middle; }
    .sh-table tr:hover { background: #fdfdfd; }

    /* ドラッグ用ハンドル */
    .drag-handle { cursor: grab; color: #ccc; font-size: 1.2rem; padding-right: 10px; }
    .drag-handle:active { cursor: grabbing; }

    /* バッジ */
    .badge { padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: bold; color: white; }
    
    /* ボタンの整理 */
    .btn-group { display: flex; gap: 5px; justify-content: center; flex-wrap: wrap; }
    .sh-btn { padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.8rem; border: none; cursor: pointer; transition: 0.2s; display: inline-flex; align-items: center; }
    .sh-btn:hover { opacity: 0.8; transform: translateY(-1px); }
    
    /* モーダル */
    .modal-overlay { display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; justify-content:center; align-items:center; backdrop-filter: blur(2px); }
    .modal-content { background:white; padding:30px; border-radius:15px; text-align:center; max-width: 90%; }
</style>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2 style="margin: 0; color: #2c3e50;"><?= esc($page_title) ?></h2>
    <div style="background: #fff; padding: 12px 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
        <form action="<?= url_to('Admin\Surveys::create') ?>" method="post" style="display: flex; gap: 10px;">
            <?= csrf_field() ?>
            <input type="text" name="title" placeholder="新しいアンケート名..." required 
                   style="padding: 10px; border: 1px solid #ddd; border-radius: 6px; width: 250px; outline: none;">
            <button type="submit" style="background: #3498db; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold;">
                新規作成
            </button>
        </form>
    </div>
</div>

<div class="survey-card">
    <table class="sh-table">
        <thead>
            <tr>
                <th style="width: 50px;"></th> <th style="width: 70px;">ID</th>
                <th style="text-align: left;">アンケートタイトル</th>
                <th style="width: 120px;">状態</th>
                <th style="width: 180px;">作成日</th>
                <th style="width: 320px;">アクション</th>
            </tr>
        </thead>
        <tbody id="sortable-list">
            <?php foreach ($surveys as $survey): ?>
            <tr data-id="<?= $survey['id'] ?>">
                <td class="drag-handle">⋮⋮</td>
                <td style="text-align: center; color: #95a5a6;">#<?= $survey['id'] ?></td>
                <td>
                    <div style="font-weight: bold; color: #2c3e50;"><?= esc($survey['title']) ?></div>
                    <?php if ($survey['is_published']): ?>
                        <span style="font-size: 0.7rem; color: #3498db;">● フロント表示中</span>
                    <?php endif; ?>
                </td>
                <td style="text-align: center;">
                    <span class="badge" style="background: <?= $survey['status'] === 'open' ? '#27ae60' : '#95a5a6' ?>;">
                        <?= $survey['status'] === 'open' ? '公開中' : '停止中' ?>
                    </span>
                </td>
                <td style="text-align: center; color: #7f8c8d; font-size: 0.85rem;">
                    <?= date('Y/m/d H:i', strtotime($survey['created_at'])) ?>
                </td>
                <td>
                    <div class="btn-group">
                        <button onclick="showQR('<?= url_to('Survey::show', $survey['id']) ?>', '<?= esc($survey['title']) ?>')" 
                                class="sh-btn" style="background: #9b59b6; color: white;">QR表示</button>
                        
                        <?php if ($survey['is_published'] == 0): ?>
                            <a href="<?= site_url('admin/surveys/publish/' . $survey['id']) ?>" 
                               class="sh-btn" style="background: #3498db; color: white;">フロント表示</a>
                        <?php endif; ?>

                        <a href="<?= url_to('Admin\Surveys::edit', $survey['id']) ?>" 
                           class="sh-btn" style="background: #f1f3f5; color: #2c3e50;">設問編集</a>
                        
                        <a href="<?= url_to('Admin\Surveys::responses', $survey['id']) ?>" 
                           class="sh-btn" style="background: #6c757d; color: white;">回答</a>

                        <a href="<?= site_url('admin/surveys/delete/' . $survey['id']) ?>" 
                           class="sh-btn" style="background: #fff; color: #e74c3c; border: 1px solid #ffc9c9;"
                           onclick="return confirm('削除してもよろしいですか？');">削除</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="qrModal" class="modal-overlay" onclick="this.style.display='none'">
    <div class="modal-content" onclick="event.stopPropagation()">
        <h3 id="qrTitle" style="margin-top:0;"></h3>
        <div id="qrContent" style="margin: 20px 0;"></div>
        <p id="qrUrl" style="font-size:0.8rem; color:#7f8c8d; word-break: break-all;"></p>
        <button onclick="document.getElementById('qrModal').style.display='none'" 
                style="padding: 8px 20px; cursor:pointer; border-radius: 6px; border: 1px solid #ddd; background: #fff;">閉じる</button>
</div>

<script>
// QR表示ロジック
function showQR(url, title) {
    const qrApi = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(url)}`;
    document.getElementById('qrTitle').innerText = title;
    document.getElementById('qrUrl').innerText = url;
    document.getElementById('qrContent').innerHTML = `<img src="${qrApi}" alt="QR Code">`;
    document.getElementById('qrModal').style.display = 'flex';
}

// 並び替えロジック
document.addEventListener('DOMContentLoaded', function() {
    const el = document.getElementById('sortable-list');
    Sortable.create(el, {
        handle: '.drag-handle',
        animation: 150,
        ghostClass: 'sortable-ghost',
        onEnd: function() {
            const ids = Array.from(el.querySelectorAll('tr')).map(tr => tr.dataset.id);
            fetch('<?= site_url("admin/surveys/reorder") ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({ ids: ids })
            })
            .then(res => res.json())
            .then(data => { if(data.status === 'success') console.log('Sorted!'); });
        }
    });
});
</script>
<?= $this->endSection() ?>