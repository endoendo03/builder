<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('content') ?>
<?php
// 表示変換用の配列
$wardMap = ['aoba'=>'青葉区', 'miyagino'=>'宮城野区', 'taihaku'=>'太白区', 'wakabayashi'=>'若林区', 'izumi'=>'泉区'];
$sylMap = ['a'=>'あ行', 'ka'=>'か行', 'sa'=>'さ行', 'ta'=>'た行', 'na'=>'な行', 'ha'=>'は行', 'ma'=>'ま行', 'ya'=>'や行', 'ra'=>'ら行', 'wa'=>'わ行'];
?>

<div class="admin-page-header">
    <h2>交通費（エリア）管理</h2>
    <button onclick="openFeeModal()" class="btn-cyan">+ 新しいエリアを追加</button>
</div>

<div style="margin-bottom: 20px;">
    <input type="text" id="adminTownSearch" class="modal-input" placeholder="🔍 町名や区で絞り込み検索..." onkeyup="filterAdminTable()">
</div>

<div class="admin-card" style="max-height: 70vh; overflow-y: auto;">
    <table class="admin-table-modern">
        <thead style="position: sticky; top: 0; background: #f8f9fa; z-index: 1;">
            <tr>
                <th>ID</th>
                <th>区</th>
                <th>行</th>
                <th>町名</th>
                <th>金額・備考</th>
                <th style="text-align: right;">アクション</th>
            </tr>
        </thead>
        <tbody id="fee-table-body">
            <?php foreach ($fees as $fee): ?>
            <tr class="fee-row">
                <td>#<?= $fee['id'] ?></td>
                <td class="td-ward"><span class="status-badge active"><?= $wardMap[$fee['ward']] ?? $fee['ward'] ?></span></td>
                <td><?= $sylMap[$fee['syllabary']] ?? $fee['syllabary'] ?></td>
                <td class="td-town"><strong><?= esc($fee['town_name']) ?></strong></td>
                <td><span style="color: #d32f2f; font-weight: bold;"><?= esc($fee['fee']) ?> <?= is_numeric($fee['fee']) ? '円' : '' ?></span></td>
                <td style="text-align: right;">
                    <button class="btn-edit-sm" onclick='editFee(<?= json_encode($fee) ?>)'>編集</button>
                    <a href="<?= base_url('admin/transport_fees/delete/'.$fee['id']) ?>" class="btn-delete-link" onclick="return confirm('本当に削除しますか？')">削除</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="feeModal" class="admin-modal-overlay" onclick="closeFeeModal()">
    <div class="admin-modal-window" onclick="event.stopPropagation()">
        <h3 id="modalTitle" style="margin-top:0; border-bottom: 1px solid #eee; padding-bottom: 15px;">交通費エリアの登録・編集</h3>
        <form action="<?= base_url('admin/transport_fees/store') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="fee_id">
            
            <div style="display: flex; gap: 15px;">
                <div class="modal-form-group" style="flex: 1;">
                    <label>区を選択</label>
                    <select name="ward" id="fee_ward" class="modal-input" required>
                        <option value="aoba">青葉区</option>
                        <option value="miyagino">宮城野区</option>
                        <option value="taihaku">太白区</option>
                        <option value="wakabayashi">若林区</option>
                        <option value="izumi">泉区</option>
                    </select>
                </div>
                <div class="modal-form-group" style="flex: 1;">
                    <label>五十音の行</label>
                    <select name="syllabary" id="fee_syl" class="modal-input" required>
                        <?php foreach($sylMap as $k => $v): ?>
                            <option value="<?= $k ?>"><?= $v ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="modal-form-group">
                <label>町名</label>
                <input type="text" name="town_name" id="fee_town" class="modal-input" placeholder="例：小田原" required>
            </div>

            <div class="modal-form-group">
                <label>金額（または「要相談」などの文字）</label>
                <input type="text" name="fee" id="fee_price" class="modal-input" placeholder="例：1000 や 要相談" required>
            </div>

            <div style="display: flex; gap: 10px; padding-top: 10px;">
                <button type="submit" class="btn-cyan" style="flex: 1;">保存する</button>
                <button type="button" onclick="closeFeeModal()" style="background:none; border:none; cursor:pointer; color:#999;">キャンセル</button>
            </div>
        </form>
    </div>
</div>

<script>
// モーダルの処理
function openFeeModal() {
    document.getElementById('fee_id').value = '';
    document.getElementById('modalTitle').innerText = '新規エリア登録';
    document.getElementById('fee_ward').value = 'aoba';
    document.getElementById('fee_syl').value = 'a';
    document.getElementById('fee_town').value = '';
    document.getElementById('fee_price').value = '1000';
    document.getElementById('feeModal').classList.add('active');
}

function editFee(data) {
    document.getElementById('fee_id').value = data.id;
    document.getElementById('modalTitle').innerText = 'エリアの編集';
    document.getElementById('fee_ward').value = data.ward;
    document.getElementById('fee_syl').value = data.syllabary;
    document.getElementById('fee_town').value = data.town_name;
    document.getElementById('fee_price').value = data.fee;
    document.getElementById('feeModal').classList.add('active');
}

function closeFeeModal() {
    document.getElementById('feeModal').classList.remove('active');
}

// リアルタイム検索
function filterAdminTable() {
    let input = document.getElementById('adminTownSearch').value.trim();
    document.querySelectorAll('.fee-row').forEach(row => {
        let townName = row.querySelector('.td-town').innerText;
        let wardName = row.querySelector('.td-ward').innerText;
        // 町名か区の名前に一致すれば表示
        if (townName.includes(input) || wardName.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>
<?= $this->endSection() ?>