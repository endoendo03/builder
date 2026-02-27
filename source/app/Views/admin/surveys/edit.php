<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('content') ?>
<style>
    /* 全体コンテナ */
    .edit-container { max-width: 900px; margin: 0 auto; padding: 20px; }
    
    /* カードスタイル */
    .sh-card { background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 25px; margin-bottom: 30px; border: 1px solid #edf2f7; }
    .sh-card h3 { margin-top: 0; margin-bottom: 20px; color: #2c3e50; font-size: 1.1rem; border-left: 4px solid #3498db; padding-left: 15px; }

    /* フォーム周り */
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; margin-bottom: 8px; font-weight: bold; color: #4a5568; font-size: 0.9rem; }
    .sh-input, .sh-select, .sh-textarea { 
        width: 100%; padding: 12px; border: 1.5px solid #eee; border-radius: 8px; 
        font-size: 0.95rem; outline: none; transition: 0.3s; background: #fdfdfd; box-sizing: border-box;
    }
    .sh-input:focus, .sh-select:focus, .sh-textarea:focus { border-color: #3498db; box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1); background: #fff; }
    .sh-textarea { min-height: 100px; resize: vertical; }

    /* テーブル */
    .sh-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    .sh-table th { text-align: left; background: #f8f9fa; color: #718096; font-size: 0.8rem; padding: 12px; text-transform: uppercase; }
    .sh-table td { padding: 15px 12px; border-bottom: 1px solid #edf2f7; font-size: 0.95rem; }
    
    /* ボタン */
    .btn-update { background: #27ae60; color: white; border: none; padding: 12px 25px; border-radius: 8px; cursor: pointer; font-weight: bold; transition: 0.2s; }
    .btn-update:hover { background: #219150; transform: translateY(-1px); }
    .btn-add { background: #3498db; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: bold; }
    .link-back { color: #95a5a6; text-decoration: none; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px; }
    .link-back:hover { color: #7f8c8d; }
</style>

<div class="edit-container">
    <div style="margin-bottom: 20px;">
        <a href="<?= url_to('Admin\Surveys::index') ?>" class="link-back">← 一覧に戻る</a>
        <h2 style="margin: 10px 0 0; color: #2c3e50;"><?= esc($page_title) ?></h2>
    </div>

    <div class="sh-card">
        <h3>基本設定</h3>
        <form action="<?= site_url('admin/surveys/update/' . $survey['id']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label class="form-label">アンケートタイトル</label>
                <input type="text" class="sh-input" name="title" value="<?= esc($survey['title']) ?>" placeholder="アンケートのタイトルを入力">
            </div>
            <div class="form-group">
                <label class="form-label">説明文</label>
                <textarea class="sh-textarea" name="description" placeholder="回答者への説明..."><?= esc($survey['description']) ?></textarea>
            </div>
            <button type="submit" class="btn-update">基本設定を更新</button>
        </form>
    </div>

    <div class="sh-card">
        <h3>設問（質問項目）の設定</h3>
        
        <table class="sh-table">
            <thead>
                <tr>
                    <th>質問内容</th>
                    <th style="width: 150px;">回答形式</th>
                    <th style="width: 80px; text-align: center;">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions as $q): ?>
                <tr>
                    <td style="font-weight: 500; color: #2d3748;"><?= esc($q['question']) ?></td>
                    <td>
                        <span style="font-size: 0.85rem; color: #718096; background: #edf2f7; padding: 4px 8px; border-radius: 4px;">
                            <?php 
                                $types = [
                                    'text'   => 'テキスト自由入力',
                                    'number' => '数値入力',
                                    'rating' => '1〜5段階評価',
                                    'radio'  => 'ラジオボタン'
                                ];
                                echo $types[$q['type']] ?? $q['type'];
                            ?>
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <a href="<?= url_to('Admin\Surveys::deleteQuestion', $q['id']) ?>" 
                           style="color: #e74c3c; font-size: 0.85rem; text-decoration: none; font-weight: bold;" 
                           onclick="return confirm('この設問を削除しますか？')">削除</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($questions)): ?>
                    <tr><td colspan="3" style="padding: 40px; text-align: center; color: #a0aec0;">設問が登録されていません。</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <hr style="border: none; border-top: 1px solid #edf2f7; margin: 30px 0;">

        <h4 style="color: #4a5568; margin-bottom: 15px;">+ 新しい設問を追加</h4>
        <form action="<?= url_to('Admin\Surveys::addQuestion', $survey['id']) ?>" method="post" 
              style="background: #f8f9fa; padding: 20px; border-radius: 10px; display: flex; flex-wrap: wrap; gap: 15px; align-items: flex-end;">
            <?= csrf_field() ?>
            
            <div style="flex: 2; min-width: 250px;">
                <label class="form-label" style="font-size: 0.8rem;">質問文</label>
                <input type="text" name="question" required class="sh-input" placeholder="例: 当店を知ったきっかけは何ですか？">
            </div>

            <div style="flex: 1; min-width: 180px;">
                <label class="form-label" style="font-size: 0.8rem;">回答形式</label>
                <select name="type" id="type-select" onchange="toggleOptions()" class="sh-select">
                    <option value="text">テキスト自由入力</option>
                    <option value="number">数値入力</option>
                    <option value="rating">1〜5段階評価</option>
                    <option value="radio">ラジオボタン（選択肢）</option>
                </select>
            </div>

            <div id="options-input" style="flex: 2; min-width: 250px; display: none;">
                <label class="form-label" style="font-size: 0.8rem;">選択肢（カンマ区切り）</label>
                <input type="text" name="options" class="sh-input" placeholder="例: SNS,知人の紹介,看板">
            </div>

            <div style="flex-shrink: 0;">
                <button type="submit" class="btn-add">追加</button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleOptions() {
    const type = document.getElementById('type-select').value;
    const optInput = document.getElementById('options-input');
    // ラジオボタンの時だけ選択肢入力を表示
    optInput.style.display = (type === 'radio') ? 'block' : 'none';
}
</script>
<?= $this->endSection() ?>