<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('content') ?>
    <h2><?= esc($page_title) ?></h2>

    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 600px;">
        <form action="<?= url_to('Admin\Coupons::create') ?>" method="post">
            <?= csrf_field() ?> <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">クーポン名</label>
                <input type="text" name="name" value="<?= old('name') ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required placeholder="例：サマーセール2024">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">クーポンコード（半角英数字）</label>
                <input type="text" name="code" value="<?= old('code') ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required placeholder="例：SUMMER500">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">割引タイプ</label>
                <label><input type="radio" name="discount_type" value="fixed" checked> 定額(円)</label>
                <label style="margin-left: 20px;"><input type="radio" name="discount_type" value="percent"> 割合(%)</label>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">割引額</label>
                <input type="number" name="discount" value="<?= old('discount') ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px;">有効期限</label>
                <input type="date" name="expire_date" value="<?= old('expire_date') ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">ステータス</label>
                <select name="status" style="width: 100%; padding: 8px;">
                    <option value="1">有効</option>
                    <option value="0">無効</option>
                </select>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" style="background: #27ae60; color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold;">この内容で発行する</button>
                <a href="<?= url_to('Admin\Coupons::index') ?>" style="background: #95a5a6; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 4px;">戻る</a>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>