<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('content') ?>
<div class="admin-page-header">
    <h2>ホテル管理</h2>
    <button onclick="openHotelModal()" class="btn-cyan">+ 新規ホテル追加</button>
</div>

<div class="admin-card">
    <table class="admin-table-modern">
        <thead>
            <tr>
                <th style="width: 40px;"></th>
                <th style="width: 60px;">ID</th>
                <th>ホテル名 / 住所</th>
                <th>交通費</th>
                <th>状態</th>
                <th style="text-align: right;">アクション</th>
            </tr>
        </thead>
        <tbody id="hotel-sortable">
            <?php foreach ($hotels as $h): ?>
            <tr data-id="<?= $h['id'] ?>">
                <td class="drag-handle" style="cursor: grab; color: #ccc;"><i class="fas fa-grip-vertical"></i></td>
                <td>#<?= $h['id'] ?></td>
                <td>
                    <strong><?= esc($h['name']) ?></strong>
                    <?php if($h['is_pickup']): ?><span style="color:#f1c40f; margin-left:5px;">★</span><?php endif; ?>
                    <div style="font-size: 11px; color: #999;"><?= esc($h['address']) ?></div>
                </td>
                <td><span style="font-weight: bold;"><?= number_format($h['transport_fee']) ?>円</span></td>
                <td>
                    <span class="status-badge <?= $h['is_available'] ? 'active' : 'inactive' ?>">
                        <?= $h['is_available'] ? '公開中' : '停止中' ?>
                    </span>
                </td>
                <td style="text-align: right;">
                    <button class="btn-edit-sm" onclick='editHotel(<?= json_encode($h) ?>)'>編集</button>
                    <a href="<?= base_url('admin/hotels/delete/'.$h['id']) ?>" class="btn-delete-link" onclick="return confirm('削除しますか？')">削除</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="hotelModal" class="admin-modal-overlay" onclick="closeHotelModal()">
    <div class="admin-modal-window" onclick="event.stopPropagation()">
        <h3 id="modalTitle" style="margin-top:0;">ホテル登録・編集</h3>
        <form action="<?= base_url('admin/hotels/store') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="hotel_id">
            
            <div class="modal-form-group">
                <label>ホテル名</label>
                <input type="text" name="name" id="hotel_name" class="modal-input" required>
            </div>

            <div style="display: flex; gap: 15px;">
                <div class="modal-form-group" style="flex: 1;">
                    <label>交通費 (円)</label>
                    <input type="number" name="transport_fee" id="hotel_fee" class="modal-input" value="0">
                </div>
                <div class="modal-form-group" style="flex: 1;">
                    <label>表示順</label>
                    <input type="number" name="sort_order" id="hotel_sort" class="modal-input" value="100">
                </div>
            </div>

            <div style="margin-bottom: 20px; display: flex; gap: 20px;">
                <label style="cursor:pointer;"><input type="checkbox" name="is_available" id="sw_available" value="1"> 公開する</label>
                <label style="cursor:pointer;"><input type="checkbox" name="is_pickup" id="sw_pickup" value="1"> ピックアップ表示</label>
            </div>

            <div class="modal-form-group">
                <label>住所 / 備考</label>
                <textarea name="address" id="hotel_address" class="modal-input" rows="2"></textarea>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn-cyan" style="flex: 1;">保存する</button>
                <button type="button" onclick="closeHotelModal()" style="background:none; border:none; cursor:pointer; color:#999;">キャンセル</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
const modal = document.getElementById('hotelModal');

function openHotelModal() {
    document.getElementById('hotel_id').value = '';
    document.getElementById('modalTitle').innerText = '新規ホテル登録';
    document.getElementById('hotel_name').value = '';
    document.getElementById('hotel_fee').value = '0';
    document.getElementById('hotel_sort').value = '100';
    document.getElementById('hotel_address').value = '';
    document.getElementById('sw_available').checked = true;
    document.getElementById('sw_pickup').checked = false;
    modal.classList.add('active');
}

function editHotel(data) {
    document.getElementById('hotel_id').value = data.id;
    document.getElementById('modalTitle').innerText = 'ホテル情報の編集';
    document.getElementById('hotel_name').value = data.name;
    document.getElementById('hotel_fee').value = data.transport_fee;
    document.getElementById('hotel_sort').value = data.sort_order;
    document.getElementById('hotel_address').value = data.address;
    document.getElementById('sw_available').checked = (data.is_available == 1);
    document.getElementById('sw_pickup').checked = (data.is_pickup == 1);
    modal.classList.add('active');
}

function closeHotelModal() { modal.classList.remove('active'); }

// 並び替え
Sortable.create(document.getElementById('hotel-sortable'), {
    handle: '.drag-handle',
    animation: 150,
    onEnd: function () {
        console.log('並び替え完了');
        // AJAXで並び順を保存する処理をここに書けます
    }
});
</script>
<?= $this->endSection() ?>