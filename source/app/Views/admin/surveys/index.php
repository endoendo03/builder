<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('content') ?>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;"><?= esc($page_title) ?></h2>
        <div style="background: #fff; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
            <form action="<?= url_to('Admin\Surveys::create') ?>" method="post" style="display: flex; gap: 10px;">
                <?= csrf_field() ?>
                <input type="text" name="title" placeholder="アンケートのタイトル" required style="padding: 8px; border: 1px solid #ccc;">
                <button type="submit" style="background: #3498db; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">
                    新規作成
                </button>
            </form>
        </div>
    </div>

    <table border="1" style="width: 100%; border-collapse: collapse; background: white;">
        <thead>
            <tr style="background-color: #ecf0f1;">
                <th style="padding: 12px; width: 7%;">ID</th>
                <th style="padding: 12px; text-align: left;">アンケート名</th>
                <th style="padding: 12px; width: 10%;">状態</th>
                <th style="padding: 12px; width: 18%;">作成日</th>
                <th style="padding: 12px; width: 20%;">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($surveys as $survey): ?>
            <tr>
                <td style="padding: 10px; text-align: center;"><?= $survey['id'] ?></td>
                <td style="padding: 10px;">
                    <strong><?= esc($survey['title']) ?></strong>
                </td>
                <td style="padding: 10px; text-align: center;">
                    <span style="padding: 2px 8px; border-radius: 12px; font-size: 0.8em; background: <?= $survey['status'] === 'open' ? '#27ae60' : '#95a5a6' ?>; color: white;">
                        <?= $survey['status'] === 'open' ? '公開中' : '停止中' ?>
                    </span>
                </td>
                <td style="padding: 10px; text-align: center; color: #666;">
                    <?= date('Y/m/d H:i', strtotime($survey['created_at'])) ?>
                </td>
                <td style="padding: 10px; text-align: center;">
                    <a href="<?= url_to('Admin\Surveys::edit', $survey['id']) ?>" style="background: #3498db; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 0.85em;">設問を編集</a>
                    <a href="<?= url_to('Admin\Surveys::responses', $survey['id']) ?>" style="background: #6c757d; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 0.85em; margin-left: 5px;">回答を見る</a>
                    <button onclick="showQR('<?= url_to('Survey::show', $survey['id']) ?>', '<?= esc($survey['title']) ?>')" style="background: #9b59b6; color: white; padding: 5px 10px; border: none; border-radius: 4px; font-size: 0.85em; cursor: pointer; margin-left: 5px;">
                        QR表示
                    </button>

                    <div id="qrModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
                        <div style="background:white; padding:30px; border-radius:10px; text-align:center; position:relative;">
                            <h3 id="qrTitle"></h3>
                            <div id="qrContent"></div>
                            <p id="qrUrl" style="font-size:0.8em; color:#666; margin-top:10px;"></p>
                            <button onclick="document.getElementById('qrModal').style.display='none'" style="margin-top:10px;">閉じる</button>
                        </div>
                    </div>

                    <script>
                    function showQR(url, title) {
                        // フルパスURLを取得
                        const fullUrl = url;
                        const qrApi = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(fullUrl)}`;
                        
                        document.getElementById('qrTitle').innerText = title;
                        document.getElementById('qrUrl').innerText = fullUrl;
                        document.getElementById('qrContent').innerHTML = `<img src="${qrApi}" alt="QR Code">`;
                        document.getElementById('qrModal').style.display = 'flex';
                    }
                    </script>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($surveys)): ?>
                <tr><td colspan="5" style="padding: 20px; text-align: center; color: #999;">まだアンケートがありません。</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
<?= $this->endSection() ?>