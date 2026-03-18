<?= $this->extend('layouts/admin_master') ?>
<?= $this->section('styles') ?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
    /* 管理画面のテイストに合わせる微調整 */
    .note-editor.note-frame { border: 1px solid #ccc; border-radius: 4px; background: #fff; }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="admin-container" style="max-width: 800px; margin: 0 auto; color: #f0f0f0;">
    <h2 style="margin-bottom: 30px; border-left: 5px solid #d4af37; padding-left: 15px;color:#333">サイト基本設定・表示制御</h2>

    <form action="<?= url_to('admin_settings_update') ?>" method="post">
        <?= csrf_field() ?>

        <div class="admin-form-group" style="margin-top: 30px;">
            <label style="font-size: 16px; color: #d32f2f; font-weight: bold;">
                <i class="fas fa-edit"></i> TOPページ フリースペース (HTML可)
            </label>
            <p style="font-size: 12px; color: #666; margin-bottom: 10px;">
                文字の色を変えたり、画像を挿入したりできます。空欄の場合は表示されません。
            </p>
            <textarea name="settings[top_free_space]" id="summernote" class="admin-textarea">
                <?= htmlspecialchars($settings['top_free_space'] ?? '') ?>
            </textarea>
        </div>

        <div class="sh-card">
            <h3 class="card-title">店舗情報設定</h3>
            <div class="form-group">
                <div class="input-item">
                    <label class="sh-label">店舗名</label>
                    <input type="text" name="settings[shop_name]" value="<?= esc($settings['shop_name'] ?? '') ?>" class="sh-input" placeholder="店舗名を入力">
                </div>
                
                <div class="input-item">
                    <label class="sh-label">電話番号</label>
                    <input type="text" name="settings[shop_tel]" value="<?= esc($settings['shop_tel'] ?? '') ?>" class="sh-input" placeholder="022-xxx-xxxx">
                </div>
                
                <div class="input-item">
                    <label class="sh-label">営業時間</label>
                    <input type="text" name="settings[shop_hours]" value="<?= esc($settings['shop_hours'] ?? '') ?>" class="sh-input" placeholder="10:00〜翌05:00">
                </div>
            </div>
        </div>

        <div class="sh-card">
            <h3 class="card-title">TOPページ表示制御</h3>
            
            <?php
            $controls = [
                'display_attendance' => ['label' => '出勤情報ボード', 'desc' => 'キャストの出勤状況を表示します'],
                'display_raw_video'  => ['label' => '生動画セクション', 'desc' => 'キャストの生動画一覧を表示します'],
                'display_exp_video'  => ['label' => '体験動画セクション', 'desc' => 'お店の体験動画を表示します'],
                'display_exp_manga'  => ['label' => '体験漫画セクション', 'desc' => 'お店の体験漫画を表示します'],
            ];
            foreach ($controls as $key => $info):
            ?>
                <div class="control-row">
                    <div>
                        <span class="control-label"><?= $info['label'] ?></span>
                        <small class="control-desc"><?= $info['desc'] ?></small>
                    </div>
                    <label class="switch">
                        <input type="hidden" name="settings[<?= $key ?>]" value="0">
                        <input type="checkbox" name="settings[<?= $key ?>]" value="1" <?= ($settings[$key] ?? '0') === '1' ? 'checked' : '' ?>>
                        <span class="slider"></span>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="submit" class="sh-btn-gold-save">設定をすべて保存する</button>
    </form>
</div>

<style>
    /* カード全体のスタイル */
    .sh-card { 
        background: #1e1e1e; /* 少し明るめの黒 */
        padding: 25px; 
        border-radius: 12px; 
        border: 1px solid #333;
        margin-bottom: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }

    /* 見出し */
    .card-title { 
        color: #d4af37; 
        font-size: 1.1rem;
        border-bottom: 1px solid #3d3d3d; 
        padding-bottom: 12px; 
        margin-bottom: 20px;
        font-weight: bold;
    }

    /* ラベル文字：ここを読みやすく修正 */
    .sh-label { 
        display: block;
        color: #e0e0e0; /* 明るいグレー */
        margin-bottom: 8px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .input-item { margin-bottom: 20px; }

    /* 入力欄 */
    .sh-input { 
        width: 100%; 
        padding: 12px; 
        background: #2a2a2a; 
        border: 1px solid #444; 
        color: #fff; 
        border-radius: 6px; 
        font-size: 1rem;
        transition: border-color 0.3s;
        box-sizing: border-box;
    }
    .sh-input:focus {
        border-color: #d4af37;
        outline: none;
        background: #333;
    }

    /* ON/OFF行 */
    .control-row { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        padding: 18px 0; 
        border-bottom: 1px solid #333; 
    }
    .control-row:last-child { border-bottom: none; }
    
    .control-label { color: #fff; font-weight: bold; display: block; }
    .control-desc { color: #888; font-size: 0.75rem; }

    /* トグルスイッチ */
    .switch { position: relative; display: inline-block; width: 54px; height: 28px; }
    .switch input { opacity: 0; width: 0; height: 0; }
    .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #444; transition: .4s; border-radius: 30px; }
    .slider:before { position: absolute; content: ""; height: 20px; width: 20px; left: 4px; bottom: 4px; background-color: white; transition: .4s; border-radius: 50%; }
    input:checked + .slider { background-color: #27ae60; }
    input:checked + .slider:before { transform: translateX(26px); }

    /* 保存ボタン */
    .sh-btn-gold-save { 
        width: 100%; 
        padding: 18px; 
        background: linear-gradient(to bottom, #d4af37, #b8962e); 
        border: none; 
        border-radius: 8px; 
        color: #000; 
        font-weight: bold; 
        font-size: 1.1rem; 
        cursor: pointer; 
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        transition: 0.3s;
    }
    .sh-btn-gold-save:hover { 
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ja-JP.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            lang: 'ja-JP',           // 日本語化
            height: 300,             // エディタの高さ
            placeholder: 'ここにキャンペーン情報やお知らせなどを自由に入力してください...',
            toolbar: [
                // 必要なツールボタンだけ残してスッキリさせる
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']] // codeviewでHTML直書きも可能！
            ]
        });
    });
</script>
<?= $this->endSection() ?>