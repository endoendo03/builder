<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('content') ?>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;"><?= esc($page_title) ?></h2>
        <a href="<?= url_to('Admin\Coupons::new') ?>" style="background-color: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
            + クーポンを新規発行
        </a>
    </div>
    
    <table border="1" style="width: 100%; border-collapse: collapse; background-color: white;">
        <thead>
            <tr style="background-color: #ecf0f1;">
                <th style="padding: 12px; text-align: center; width: 50px;">ID</th>
                <th style="padding: 12px; text-align: left;">クーポン名</th>
                <th style="padding: 12px; text-align: left; width: 120px;">割引内容</th>
                <th style="padding: 12px; text-align: center; width: 150px;">コード</th>
                <th style="padding: 12px; text-align: center; width: 120px;">有効期限</th>
                <th style="padding: 12px; text-align: center; width: 80px;">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $today = date('Y-m-d');
            foreach ($coupons as $coupon): 
                // 判定ロジック
                $is_expired = ($coupon['expire_date'] < $today);
                $is_disabled = ($coupon['status'] == 0);
                $is_inactive = ($is_expired || $is_disabled);
                
                // 行のスタイル（無効・期限切れならグレー）
                $row_style = $is_inactive ? 'background-color: #f2f2f2; color: #999;' : '';
            ?>
            <tr style="<?= $row_style ?>">
                <td style="padding: 10px; text-align: center;"><?= $coupon['id'] ?></td>
                <td style="padding: 10px;">
                    <div style="font-weight: bold;"><?= esc($coupon['name']) ?></div>
                    <?php if ($is_disabled): ?>
                        <span style="color: #e74c3c; font-size: 0.8em; font-weight: bold;">[無効設定中]</span>
                    <?php endif; ?>
                    <?php if ($is_expired): ?>
                        <span style="color: #f39c12; font-size: 0.8em; font-weight: bold;">[期限切れ]</span>
                    <?php endif; ?>
                </td>
                <td style="padding: 10px;">
                    <?php if ($coupon['discount_type'] === 'percent'): ?>
                        <span style="font-weight: bold; color: <?= $is_inactive ? '#999' : '#e67e22' ?>;"><?= esc($coupon['discount']) ?>% OFF</span>
                    <?php else: ?>
                        <span style="font-weight: bold; color: <?= $is_inactive ? '#999' : '#e74c3c' ?>;">¥<?= number_format($coupon['discount']) ?> OFF</span>
                    <?php endif; ?>
                </td>
                <td style="padding: 10px; text-align: center;">
                    <code style="background: <?= $is_inactive ? '#eee' : '#f8f9fa' ?>; padding: 4px 8px; border-radius: 4px; border: 1px solid #ddd;">
                        <?= esc($coupon['code']) ?>
                    </code>
                </td>
                <td style="padding: 10px; text-align: center;">
                    <?= $coupon['expire_date'] ?>
                </td>
                <td style="padding: 10px; text-align: center;">
                    <a href="<?= url_to('Admin\Coupons::edit', $coupon['id']) ?>" style="background: <?= $is_inactive ? '#bdc3c7' : '#3498db' ?>; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 0.85em;">
                        編集
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>

            <?php if (empty($coupons)): ?>
                <tr>
                    <td colspan="6" style="padding: 20px; text-align: center; color: #999;">登録されているクーポンはありません。</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?= $this->endSection() ?>