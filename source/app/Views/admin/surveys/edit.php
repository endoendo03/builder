<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('content') ?>
    <h2><?= esc($page_title) ?></h2>

    <div style="background: #fff; padding: 20px; border-radius: 8px; margin-bottom: 30px; border: 1px solid #ddd;">
        <h3>基本設定</h3>
        <p><strong>タイトル:</strong> <?= esc($survey['title']) ?></p>
        <p><strong>説明:</strong> <?= nl2br(esc($survey['description'])) ?></p>
    </div>

    <div style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
        <h3>設問（質問項目）の設定</h3>
        
        <table border="1" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead style="background: #f8f9fa;">
                <tr>
                    <th style="padding: 10px;">質問内容</th>
                    <th style="padding: 10px;">回答形式</th>
                    <th style="padding: 10px; width: 80px;">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions as $q): ?>
                <tr>
                    <td style="padding: 10px;"><?= esc($q['question']) ?></td>
                    <td style="padding: 10px; text-align: center;">
                        <?= $q['type'] === 'text' ? 'テキスト自由入力' : ($q['type'] === 'number' ? '数値入力' : 'ラジオボタン') ?>
                    </td>
                    <td style="padding: 10px; text-align: center;">
                        <a href="<?= url_to('Admin\Surveys::deleteQuestion', $q['id']) ?>" style="color: red;" onclick="return confirm('削除しますか？')">削除</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($questions)): ?>
                    <tr><td colspan="3" style="padding: 20px; text-align: center; color: #999;">設問が登録されていません。</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <hr>
        <h4>+ 新しい設問を追加</h4>
        <form action="<?= url_to('Admin\Surveys::addQuestion', $survey['id']) ?>" method="post" style="display: flex; flex-wrap: wrap; gap: 10px; align-items: flex-end; background: #f9f9f9; padding: 15px; border-radius: 5px;">
            <?= csrf_field() ?>
            <div style="flex: 2; min-width: 200px;">
                <label style="display: block; font-size: 0.8em;">質問文</label>
                <input type="text" name="question" required style="width: 100%; padding: 8px;">
            </div>
            <div style="flex: 1; min-width: 150px;">
                <label style="display: block; font-size: 0.8em;">回答形式</label>
                <select name="type" id="type-select" onchange="toggleOptions()" style="width: 100%; padding: 8px;">
                    <option value="text">テキスト自由入力</option>
                    <option value="number">数値入力</option>
                    <option value="rating">1〜5段階評価</option> <option value="radio">ラジオボタン（選択肢）</option> </select>
            </div>
            <div id="options-input" style="flex: 2; min-width: 200px; display: none;">
                <label style="display: block; font-size: 0.8em;">選択肢（カンマ区切り）</label>
                <input type="text" name="options" style="width: 100%; padding: 8px;" placeholder="例: 良い,普通,悪い">
            </div>
            <button type="submit" style="background: #27ae60; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">追加</button>
        </form>

        <script>
        function toggleOptions() {
            const type = document.getElementById('type-select').value;
            document.getElementById('options-input').style.display = (type === 'radio') ? 'block' : 'none';
        }
        </script>
    </div>

    <div style="margin-top: 20px;">
        <a href="<?= url_to('Admin\Surveys::index') ?>" style="color: #666;">一覧に戻る</a>
    </div>
<?= $this->endSection() ?>