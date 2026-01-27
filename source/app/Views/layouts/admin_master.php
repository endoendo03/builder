<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> | 管理画面</title>

    <link rel="stylesheet" href="/css/admin.css">

    <?= $this->renderSection('styles') ?>
</head>
<body>

    <header id="admin-header">
        <h1>管理システムダッシュボード</h1>
    </header>

    <div id="admin-container">
        
        <nav id="admin-sidebar">
            <?= $this->include('layouts/_sidebar') ?>
        </nav>

        <main id="admin-content">
            <?= $this->renderSection('content') ?>
        </main>

    </div>

    <?= $this->renderSection('scripts') ?>
</body>
</html>