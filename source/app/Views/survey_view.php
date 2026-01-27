<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?= esc($survey['title']) ?></title>
    <style>
        body { font-family: sans-serif; background: #f4f7f6; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .question-block { margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 10px; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; box-sizing: border-box; }
        button { background: #3498db; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 1.1em; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= esc($survey['title']) ?></h1>
        <p><?= nl2br(esc($survey['description'])) ?></p>
        <hr>

        <form action="<?= url_to('Survey::submit', $survey['id']) ?>" method="post">
            <?= csrf_field() ?>

            <?php foreach ($questions as $q): ?>
                <div class="question-block">
                    <label><?= esc($q['question']) ?></label>
                    
                    <?php if ($q['type'] === 'text'): ?>
                        <input type="text" name="answers[<?= $q['id'] ?>]" required>
                    
                    <?php elseif ($q['type'] === 'number'): ?>
                        <input type="number" name="answers[<?= $q['id'] ?>]" required>
                    
                    <?php elseif ($q['type'] === 'radio'): ?>
                        <label style="font-weight: normal;"><input type="radio" name="answers[<?= $q['id'] ?>]" value="はい" required> はい</label>
                        <label style="font-weight: normal;"><input type="radio" name="answers[<?= $q['id'] ?>]" value="いいえ" required> いいえ</label>
                    <?php elseif ($q['type'] === 'rating'): ?>
                        <div style="display: flex; gap: 15px;">
                            <?php for($i=1; $i<=5; $i++): ?>
                                <label style="font-weight: normal; text-align: center;">
                                    <input type="radio" name="answers[<?= $q['id'] ?>]" value="<?= $i ?>" required><br><?= $i ?>
                                </label>
                            <?php endfor; ?>
                            <span style="font-size: 0.8em; align-self: center; margin-left: 10px;">(5が最高)</span>
                        </div>

                    <?php elseif ($q['type'] === 'radio'): ?>
                        <?php 
                            $opts = explode(',', $q['options'] ?? ''); 
                            foreach($opts as $opt): $opt = trim($opt);
                        ?>
                            <label style="font-weight: normal; margin-bottom: 5px; display: block;">
                                <input type="radio" name="answers[<?= $q['id'] ?>]" value="<?= $opt ?>" required> <?= esc($opt) ?>
                            </label>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <button type="submit">回答を送信する</button>
        </form>
    </div>
</body>
</html>