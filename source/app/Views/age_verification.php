<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>年齢認証 | 人妻生レンタル仙台店</title>
    <style>
        body { margin: 0; background: #000; color: #fff; font-family: sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; overflow: hidden; }
        .age-gate-container { text-align: center; padding: 40px; border: 1px solid #bf953f; border-radius: 20px; background: rgba(20, 20, 20, 0.8); max-width: 500px; width: 90%; }
        .logo { font-size: 32px; color: #bf953f; margin-bottom: 30px; font-weight: bold; }
        h1 { font-size: 24px; margin-bottom: 20px; color: #f5f5f5; }
        p { font-size: 14px; color: #aaa; line-height: 1.6; margin-bottom: 30px; }
        .btn-group { display: flex; gap: 20px; justify-content: center; }
        .btn { padding: 15px 40px; border-radius: 30px; text-decoration: none; font-weight: bold; cursor: pointer; transition: 0.3s; }
        .btn-yes { background: #bf953f; color: #000; border: none; }
        .btn-yes:hover { background: #dfb55f; transform: scale(1.05); }
        .btn-no { background: transparent; color: #999; border: 1px solid #444; }
        .btn-no:hover { color: #fff; border-color: #fff; }
    </style>
</head>
<body>
    <div class="age-gate-container">
        <div class="logo"><img style="width:100%;" src="<?= base_url('images/logo.png') ?>" alt="人妻生レンタル仙台店"></div>
        <h1>年齢確認</h1>
        <p>あなたは18歳以上ですか？<br>このサイトにはアダルトコンテンツが含まれています。18歳未満の方の閲覧は固くお断りいたします。</p>
        <div class="btn-group">
            <a href="<?= site_url('verify-age') ?>" class="btn btn-yes">はい、18歳以上です</a>
            <a href="https://www.google.com" class="btn btn-no">いいえ</a>
        </div>
        <?php if (!empty($tags['footer_tags'])): ?>
            <div class="entrance-banners" style="margin-top: 40px;">
                <?= $tags['footer_tags'] // ⚠️タグなのでesc()は付けません ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>