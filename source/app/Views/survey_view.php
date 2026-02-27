<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($survey['title']) ?></title>
    <style>
        :root { --primary-color: #3498db; --bg-color: #f0f2f5; --text-dark: #2c3e50; }
        body { font-family: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", "Hiragino Sans", Meiryo, sans-serif; background: var(--bg-color); color: var(--text-dark); margin: 0; padding: 15px; line-height: 1.6; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 25px 20px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        
        h1 { font-size: 1.4rem; margin-top: 0; color: var(--primary-color); text-align: center; }
        .description { font-size: 0.95rem; color: #666; margin-bottom: 25px; background: #f8f9fa; padding: 15px; border-radius: 10px; border-left: 4px solid var(--primary-color); }

        .question-block { margin-bottom: 30px; }
        .question-label { display: block; font-weight: bold; margin-bottom: 12px; font-size: 1.05rem; }

        /* 入力欄の共通スタイル */
        input[type="text"], input[type="number"] {
            width: 100%; padding: 14px; font-size: 16px; /* 16px以下だとiPhoneでズームしちゃうのを防止 */
            border: 2px solid #eee; border-radius: 10px; box-sizing: border-box; transition: 0.3s; outline: none;
        }
        input:focus { border-color: var(--primary-color); background: #fdfdfd; }

        /* ★ラジオボタンを「ボタン」に変える魔法 */
        .choice-group { display: flex; flex-direction: column; gap: 10px; }
        .choice-label {
            display: block; position: relative; padding: 14px 15px 14px 45px;
            background: #fff; border: 2px solid #eee; border-radius: 10px;
            cursor: pointer; transition: 0.2s; font-size: 1rem;
        }
        .choice-label input { position: absolute; opacity: 0; }
        .choice-label::before {
            content: ""; position: absolute; left: 15px; top: 50%; transform: translateY(-50%);
            width: 20px; height: 20px; border: 2px solid #ddd; border-radius: 50%; background: #fff;
        }
        /* 選択された時のスタイル */
        .choice-label:has(input:checked) { border-color: var(--primary-color); background: #ebf5ff; font-weight: bold; }
        .choice-label:has(input:checked)::before { border-color: var(--primary-color); background: var(--primary-color); box-shadow: inset 0 0 0 4px #fff; }

        /* 5段階評価の横並びスタイル */
        .rating-group { display: grid; grid-template-columns: repeat(5, 1fr); gap: 8px; }
        .rating-label {
            aspect-ratio: 1/1; display: flex; align-items: center; justify-content: center;
            border: 2px solid #eee; border-radius: 10px; font-weight: bold; font-size: 1.2rem; cursor: pointer;
        }
        .rating-label input { display: none; }
        .rating-label:has(input:checked) { background: var(--primary-color); color: white; border-color: var(--primary-color); }

        button.submit-btn {
            background: var(--primary-color); color: white; border: none; padding: 18px;
            border-radius: 12px; cursor: pointer; width: 100%; font-size: 1.15rem; font-weight: bold;
            box-shadow: 0 4px 0 #2980b9; margin-top: 10px; transition: 0.2s;
        }
        button.submit-btn:active { transform: translateY(2px); box-shadow: 0 2px 0 #2980b9; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= esc($survey['title']) ?></h1>
        <?php if (!empty($survey['description'])): ?>
            <div class="description"><?= nl2br(esc($survey['description'])) ?></div>
        <?php endif; ?>

        <form action="<?= url_to('Survey::submit', $survey['id']) ?>" method="post">
            <?= csrf_field() ?>

            <?php foreach ($questions as $q): ?>
                <div class="question-block">
                    <label class="question-label"><?= esc($q['question']) ?></label>
                    
                    <?php if ($q['type'] === 'text'): ?>
                        <input type="text" name="answers[<?= $q['id'] ?>]" placeholder="回答を入力..." required>
                    
                    <?php elseif ($q['type'] === 'number'): ?>
                        <input type="number" name="answers[<?= $q['id'] ?>]" placeholder="数値を入力..." required>
                    
                    <?php elseif ($q['type'] === 'radio'): ?>
                        <div class="choice-group">
                            <?php 
                                // カンマ区切り、または「はい,いいえ」のデフォルト処理
                                $options = !empty($q['options']) ? explode(',', $q['options']) : ['はい', 'いいえ'];
                                foreach($options as $opt): $opt = trim($opt);
                            ?>
                                <label class="choice-label">
                                    <input type="radio" name="answers[<?= $q['id'] ?>]" value="<?= esc($opt) ?>" required>
                                    <?= esc($opt) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>

                    <?php elseif ($q['type'] === 'rating'): ?>
                        <div class="rating-group">
                            <?php for($i=1; $i<=5; $i++): ?>
                                <label class="rating-label">
                                    <input type="radio" name="answers[<?= $q['id'] ?>]" value="<?= $i ?>" required>
                                    <?= $i ?>
                                </label>
                            <?php endfor; ?>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 0.75rem; color: #999; margin-top: 5px; padding: 0 5px;">
                            <span>不満</span>
                            <span>満足</span>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="submit-btn">回答を送信する</button>
        </form>
    </div>
</body>
</html>