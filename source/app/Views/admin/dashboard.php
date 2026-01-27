<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('title') ?>
    <?= esc($page_title) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <p>管理画面へようこそ。システムの状態をここで確認できます。</p>

    <div class="summary-cards" style="display: flex; gap: 20px;">
        <div style="background: #eaf8f5; padding: 20px; border-left: 5px solid #1abc9c; flex: 1;">
            <h3>新規登録ユーザー数</h3>
            <p style="font-size: 2em; margin: 5px 0; color: #1abc9c;"><?= esc($latest_users_count) ?>名</p>
            <p style="font-size: 0.9em; color: #7f8c8d;">過去30日間</p>
        </div>

        <div style="background: #fcf4e8; padding: 20px; border-left: 5px solid #f39c12; flex: 1;">
            <h3>今月の売上総額</h3>
            <p style="font-size: 2em; margin: 5px 0; color: #f39c12;"><?= esc($latest_sales_amount) ?></p>
            <p style="font-size: 0.9em; color: #7f8c8d;">今月累計</p>
        </div>
    </div>

    <h3 style="margin-top: 40px;">クイックアクション</h3>
    <ul>
        <li><a href="#" style="color: #2980b9;">新しいコンテンツを作成</a></li>
        <li><a href="#" style="color: #2980b9;">最新のログを確認</a></li>
    </ul>

<?= $this->endSection() ?>