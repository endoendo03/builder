<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('content') ?>
    <h2><?= esc($page_title) ?></h2>
    
    <div style="margin-bottom: 20px;">
        <a href="<?= url_to('Admin\Surveys::index') ?>" style="color: #666;">← アンケート一覧に戻る</a>
    </div>

    <div style="overflow-x: auto; background: white; border-radius: 8px; border: 1px solid #ddd;">
        <table border="1" style="width: 100%; border-collapse: collapse; min-width: 800px;">
            <thead>
                <tr style="background-color: #f8f9fa;">
                    <th style="padding: 12px; width: 150px;">回答日時</th>
                    <th style="padding: 12px; width: 100px;">ユーザーID</th>
                    <?php foreach ($questionsById as $qText): ?>
                        <th style="padding: 12px; text-align: left; min-width: 150px;">
                            <?= esc($qText) ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($responses as $res): ?>
                    <?php $answers = json_decode($res['answers_json'], true); ?>
                    <tr>
                        <td style="padding: 10px; text-align: center; font-size: 0.85em; color: #666;">
                            <?= date('Y/m/d H:i', strtotime($res['created_at'])) ?>
                        </td>
                        <td style="padding: 10px; text-align: center;">
                            <?= $res['user_id'] ?: '<span style="color:#ccc;">ゲスト</span>' ?>
                        </td>
                        <?php foreach ($questionsById as $qId => $qText): ?>
                            <td style="padding: 10px;">
                                <?= esc($answers[$qId] ?? '-') ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($responses)): ?>
                    <tr>
                        <td colspan="<?= count($questionsById) + 2 ?>" style="padding: 30px; text-align: center; color: #999;">
                            まだ回答がありません。
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?= $this->endSection() ?>