<?= $this->extend('layouts/admin_master') ?>
<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2 style="margin: 0;"><?= esc($page_title) ?></h2>
    </div>

<div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #dee2e6;">
    <form action="<?= url_to('Admin\Users::index') ?>" method="get" style="display: flex; flex-wrap: wrap; gap: 15px; align-items: flex-end;">
        <div>
            <label style="display: block; font-size: 0.8em; color: #666;">名前</label>
            <input type="text" name="username" value="<?= esc($search['username'] ?? '') ?>" style="padding: 6px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div>
            <label style="display: block; font-size: 0.8em; color: #666;">メールアドレス</label>
            <input type="text" name="email" value="<?= esc($search['email'] ?? '') ?>" style="padding: 6px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div>
            <label style="display: block; font-size: 0.8em; color: #666;">電話番号</label>
            <input type="text" name="phone" value="<?= esc($search['phone'] ?? '') ?>" style="padding: 6px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div>
            <label style="display: block; font-size: 0.8em; color: #666;">ステータス</label>
            <select name="status" style="padding: 6px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="">すべて</option>
                <option value="active" <?= ($search['status'] ?? '') === 'active' ? 'selected' : '' ?>>有効</option>
                <option value="suspended" <?= ($search['status'] ?? '') === 'suspended' ? 'selected' : '' ?>>一時停止</option>
                <option value="banned" <?= ($search['status'] ?? '') === 'banned' ? 'selected' : '' ?>>強制退会</option>
            </select>
        </div>
        <button type="submit" style="background: #6c757d; color: white; border: none; padding: 8px 20px; border-radius: 4px; cursor: pointer;">検索</button>
        <a href="<?= url_to('Admin\Users::index') ?>" style="text-decoration: none; font-size: 0.8em; color: #666;">クリア</a>
    </form>
</div>

<table border="1" style="width: 100%; border-collapse: collapse; background: white;">
    <thead>
        <tr style="background-color: #ecf0f1;">
            <th style="padding: 12px;">ID</th>
            <th style="padding: 12px;">会員情報</th>
            <th style="padding: 12px;">ステータス/ランク</th>
            <th style="padding: 12px;">管理者メモ</th>
            <th style="padding: 12px;">操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <?php
                // ステータス別のバッジ色設定
                $status_color = ['active' => '#27ae60', 'suspended' => '#f39c12', 'banned' => '#e74c3c'][$user['status']] ?? '#95a5a6';
                $rank_label = ['regular' => '一般', 'silver' => 'シルバー', 'gold' => 'ゴールド'][$user['rank']] ?? '未設定';
            ?>
            <tr>
                <td style="padding: 10px; text-align: center;"><?= $user['id'] ?></td>
                <td style="padding: 10px;">
                    <strong><?= esc($user['username']) ?></strong><br>
                    <small style="color: #666;"><?= esc($user['email']) ?></small><br>
                    <small style="color: #666;"><?= esc($user['phone']) ?></small>
                </td>
                <td style="padding: 10px; text-align: center;">
                    <span style="background: <?= $status_color ?>; color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.8em;">
                        <?= esc($user['status']) ?>
                    </span>
                    <div style="margin-top: 5px; font-size: 0.9em; font-weight: bold;">
                        ランク: <?= $rank_label ?>
                    </div>
                </td>
                <td style="padding: 10px; font-size: 0.9em; color: #555;">
                    <?= nl2br(esc(mb_strimwidth($user['admin_memo'] ?? '', 0, 100, "..."))) ?>
                </td>
                <td style="padding: 10px; text-align: center;">
                    <a href="<?= url_to('Admin\Users::edit', $user['id']) ?>" style="background: #3498db; color: white; padding: 5px 12px; text-decoration: none; border-radius: 4px; font-size: 0.85em;">詳細・編集</a>
                    </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>