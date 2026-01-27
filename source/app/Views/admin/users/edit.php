<?= $this->extend('layouts/admin_master') ?>
<?= $this->section('content') ?>
    <h2><?= esc($page_title) ?></h2>

    <form action="<?= url_to('Admin\Users::update', $user['id']) ?>" method="post">
        <?= csrf_field() ?>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px;">
                <h3>基本情報</h3>
                <p><strong>ユーザー名:</strong> <?= esc($user['username']) ?></p>
                <p><strong>メールアドレス:</strong> <?= esc($user['email']) ?></p>
            </div>

            <div style="background: #fff; padding: 15px; border: 1px solid #ddd; border-radius: 8px;">
                <h3>管理者設定</h3>
                <div style="margin-bottom: 10px;">
                    <label>会員ステータス</label>
                    <select name="status" style="width: 100%; padding: 5px;">
                        <option value="active" <?= $user['status'] == 'active' ? 'selected' : '' ?>>有効</option>
                        <option value="suspended" <?= $user['status'] == 'suspended' ? 'selected' : '' ?>>一時停止</option>
                        <option value="banned" <?= $user['status'] == 'banned' ? 'selected' : '' ?>>強制退会</option>
                    </select>
                </div>
                <div style="margin-bottom: 10px;">
                    <label>会員ランク</label>
                    <select name="rank" style="width: 100%; padding: 5px;">
                        <option value="regular" <?= $user['rank'] == 'regular' ? 'selected' : '' ?>>一般</option>
                        <option value="silver" <?= $user['rank'] == 'silver' ? 'selected' : '' ?>>シルバー</option>
                        <option value="gold" <?= $user['rank'] == 'gold' ? 'selected' : '' ?>>ゴールド</option>
                    </select>
                </div>
            </div>
        </div>

        <div style="margin-top: 20px;">
            <label>管理者メモ（ユーザーには見えません）</label>
            <textarea name="admin_memo" style="width: 100%; height: 100px;"><?= esc($user['admin_memo']) ?></textarea>
        </div>

        <button type="submit" style="margin-top: 20px; background: #27ae60; color: white; padding: 10px 30px; border: none; border-radius: 4px;">保存する</button>
    </form>
<?= $this->endSection() ?>