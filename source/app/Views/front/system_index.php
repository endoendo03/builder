<?= $this->extend('layouts/front_master') ?>

<?= $this->section('content') ?>
<div class="system-page">
    <div class="diary-section-title">料金システム</div>

    <div class="charge-table-wrapper" style="margin-bottom: 30px;">
        <table class="system-table">
            <tr><th>入会金</th><td>無料</td></tr>
            <tr><th>指名料</th><td>2,000円</td></tr>
            <tr><th>延長10分</th><td>3,000円</td></tr>
            <tr><th>チェンジ</th><td>2,000円</td></tr>
            <tr><th>キャンセル</th><td>3,000円</td></tr>
        </table>
    </div>

    <?php if (!empty($system['chargeList'])): ?>
        <?php foreach ($system['chargeList'] as $course): ?>
            <div class="course-group" style="margin-bottom: 40px;">
                <div class="course-header" style="background: #333; padding: 5px 10px; border-left: 5px solid #d32f2f; margin-bottom: 10px; font-weight: bold;">
                    <?= esc($course['name']) ?>
                </div>
                
                <table class="system-table price-table">
                    <tbody>
                        <?php foreach ($course['list'] as $term): ?>
                            <tr><th></th><th><?= esc($term['term']) ?></th></tr>
                            <?php foreach ($term['list'] as $charge): ?>
                                <tr>
                                    <td style="text-align: center; width: 40%;"><?= esc($charge['course_time']) ?>分</td>
                                    <td style="text-align: right;"><?= number_format($charge['price']) ?>円</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <?php if (!empty($course['notes'])): ?>
                    <p style="font-size: 11px; color: #ccc; margin-top: 8px; line-height: 1.5;">
                        <?= nl2br(esc($course['notes'])) ?>
                    </p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    </div>

<style>
/* 料金システム専用のテーブルスタイル */
.system-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 10px;
    background: #000;
}
.system-table th, .system-table td {
    border: 1px solid #444;
    padding: 10px;
    font-size: 14px;
}
.system-table th {
    background: #1a1a1a;
    color: #ccc;
    text-align: left;
    width: 30%;
}
.price-table thead th {
    background: #222;
    text-align: center;
    color: #fff;
}
@media (max-width: 768px) {
    .system-table th, .system-table td {
        font-size: 12px;
        padding: 8px;
    }
}
</style>
<?= $this->endSection() ?>