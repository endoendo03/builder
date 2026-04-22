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

    <div class="diary-section-title" style="margin-top: 50px;">出張交通費</div>

    <p style="color: #ccc; font-size: 13px; line-height: 1.6; margin-bottom: 20px;">
        <?= nl2br(esc($transportFeeNote ?? '※仙台市外の方はお気軽にご相談ください。')) ?>
    </p>

    <div class="area-search-box">
        <input type="text" id="townSearch" class="area-search-input" placeholder="町名で検索 (例: 小田原)" onkeyup="filterTowns()">
    </div>

    <div class="ward-tabs">
        <div class="ward-tab active" onclick="switchWard('aoba', this)">青葉区</div>
        <div class="ward-tab" onclick="switchWard('miyagino', this)">宮城野区</div>
        <div class="ward-tab" onclick="switchWard('wakabayashi', this)">若林区</div>
        <div class="ward-tab" onclick="switchWard('taihaku', this)">太白区</div>
        <div class="ward-tab" onclick="switchWard('izumi', this)">泉区</div>
    </div>

    <div class="transport-fee-container">
        <?php 
        $wards = ['aoba', 'miyagino', 'wakabayashi', 'taihaku', 'izumi'];
        $sylNames = ['a'=>'あ行', 'ka'=>'か行', 'sa'=>'さ行', 'ta'=>'た行', 'na'=>'な行', 'ha'=>'は行', 'ma'=>'ま行', 'ya'=>'や行', 'ra'=>'ら行', 'wa'=>'わ行'];
        ?>
        
        <?php foreach ($wards as $index => $w): ?>
            <div id="ward-<?= $w ?>" class="fee-section <?= $w === 'aoba' ? 'active' : '' ?>">
                
                <?php if (empty($system['groupedFees'][$w])): ?>
                    <p style="text-align: center; color: #666; padding: 20px;">データがありません</p>
                <?php else: ?>
                    <?php foreach ($sylNames as $sylKey => $sylName): ?>
                        <?php if (!empty($system['groupedFees'][$w][$sylKey])): ?>
                            <div class="syllabary-group">
                                <div class="syllabary-header"><?= $sylName ?></div>
                                <ul class="fee-list">
                                    <?php foreach ($system['groupedFees'][$w][$sylKey] as $feeData): ?>
                                        <li class="fee-item">
                                            <span class="town-name"><?= esc($feeData['town_name']) ?></span>
                                            <span class="town-price">
                                                <?= is_numeric($feeData['fee']) ? number_format($feeData['fee']) . '円' : esc($feeData['fee']) ?>
                                            </span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    </div>

</div>

<style>
/* 既存のスタイル */
.system-table { width: 100%; border-collapse: collapse; margin-bottom: 10px; background: #000; }
.system-table th, .system-table td { border: 1px solid #444; padding: 10px; font-size: 14px; color: #eee; }
.system-table th { background: #1a1a1a; color: #ccc; text-align: left; width: 30%; }
.price-table thead th { background: #222; text-align: center; color: #fff; }

/* 交通費セクション専用のダークテーマスタイル */
.area-search-box { margin-bottom: 20px; }
.area-search-input { width: 100%; padding: 12px 15px; font-size: 16px; background: #111; color: #fff; border: 1px solid #444; border-radius: 6px; box-sizing: border-box; }
.area-search-input:focus { border-color: #d32f2f; outline: none; box-shadow: 0 0 5px rgba(211, 47, 47, 0.5); }

.ward-tabs { display: flex; overflow-x: auto; gap: 8px; margin-bottom: 20px; padding-bottom: 10px; scrollbar-width: none; }
.ward-tabs::-webkit-scrollbar { display: none; }
.ward-tab { padding: 8px 16px; background: #222; border: 1px solid #444; border-radius: 20px; font-weight: bold; color: #ccc; cursor: pointer; white-space: nowrap; font-size: 13px; transition: 0.2s; }
.ward-tab.active { background: #d32f2f; color: #fff; border-color: #d32f2f; }

.fee-section { display: none; }
.fee-section.active { display: block; animation: fadeIn 0.3s ease-in-out; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

.syllabary-header { background: #1a1a1a; padding: 6px 15px; font-weight: bold; color: #eee; border-left: 4px solid #d32f2f; margin: 15px 0 5px 0; font-size: 14px; }
.fee-list { list-style: none; padding: 0; margin: 0; }
.fee-item { display: flex; justify-content: space-between; padding: 12px 10px; border-bottom: 1px solid #333; font-size: 14px; }
.fee-item:last-child { border-bottom: none; }
.town-name { color: #fff; }
.town-price { color: #ff5252; font-weight: bold; }

@media (max-width: 768px) {
    .system-table th, .system-table td { font-size: 12px; padding: 8px; }
    .ward-tab { padding: 8px 14px; font-size: 12px; }
    .fee-item { font-size: 13px; padding: 10px 5px; }
}
</style>

<script>
// タブ切り替え処理
function switchWard(wardId, element) {
    document.getElementById('townSearch').value = '';
    filterTowns();
    document.querySelectorAll('.ward-tab').forEach(tab => tab.classList.remove('active'));
    element.classList.add('active');
    document.querySelectorAll('.fee-section').forEach(sec => sec.classList.remove('active'));
    document.getElementById('ward-' + wardId).classList.add('active');
}

// リアルタイム検索処理
function filterTowns() {
    let input = document.getElementById('townSearch').value.trim();
    
    document.querySelectorAll('.fee-section.active .fee-item').forEach(item => {
        let townName = item.querySelector('.town-name').innerText;
        if (townName.includes(input)) {
            item.style.display = 'flex';
        } else {
            item.style.display = 'none';
        }
    });

    // 非表示になった行の見出し（あ行など）を隠す
    document.querySelectorAll('.fee-section.active .syllabary-group').forEach(group => {
        let visibleItems = Array.from(group.querySelectorAll('.fee-item')).filter(i => i.style.display !== 'none');
        group.style.display = visibleItems.length > 0 ? 'block' : 'none';
    });
}
</script>
<?= $this->endSection() ?>