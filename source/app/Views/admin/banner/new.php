<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('content') ?>
<style>
    .sh-card { background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 30px; max-width: 700px; margin: 20px auto; }
    .form-group { margin-bottom: 25px; }
    .form-label { display: block; margin-bottom: 8px; font-weight: bold; color: #2c3e50; font-size: 0.9rem; }
    
    .sh-input, .sh-select { 
        width: 100%; padding: 12px; border: 1.5px solid #eee; border-radius: 8px; 
        font-size: 1rem; outline: none; transition: 0.3s; background: #fdfdfd; box-sizing: border-box;
    }
    .sh-input:focus, .sh-select:focus { border-color: #3498db; box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1); background: #fff; }

    /* 画像プレビューエリア */
    #image-preview { 
        margin-top: 15px; width: 100%; min-height: 150px; border: 2px dashed #ddd; 
        border-radius: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden;
    }
    #image-preview img { max-width: 100%; max-height: 300px; display: block; }

    .btn-save { 
        background: #27ae60; color: white; border: none; padding: 15px 30px; 
        border-radius: 8px; cursor: pointer; font-weight: bold; width: 100%; font-size: 1rem; transition: 0.2s;
    }
    .btn-save:hover { background: #219150; transform: translateY(-1px); }
</style>

<div class="sh-card">
    <div style="margin-bottom: 30px; border-bottom: 2px solid #f8f9fa; padding-bottom: 15px;">
        <h2 style="margin:0; color:#2c3e50;">バナーの新規登録</h2>
    </div>

    <form action="<?= site_url('admin/banner/create') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label class="form-label">設置場所</label>
            <select name="place" class="sh-select" required>
                <option value="top_pc" <?= $place === 'top_pc' ? 'selected' : '' ?>>TOPページ（PC用）</option>
                <option value="top_sp" <?= $place === 'top_sp' ? 'selected' : '' ?>>TOPページ（スマホ用）</option>
                <option value="right_column" <?= $place === 'right_column' ? 'selected' : '' ?>>右カラム</option>
                <option value="render_shop" <?= $place === 'render_shop' ? 'selected' : '' ?>>系列店バナー</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">バナータイトル（管理用）</label>
            <input type="text" name="title" class="sh-input" placeholder="例：2月イベント告知バナー" required>
        </div>

        <div class="form-group">
            <label class="form-label">バナー画像</label>
            <input type="file" name="image" id="banner-image" class="sh-input" accept="image/*" required>
            <div id="image-preview">
                <span style="color: #999;">画像を選択するとプレビューが表示されます</span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">リンク先URL（任意）</label>
            <input type="url" name="link_url" class="sh-input" placeholder="https://...">
        </div>

        <div class="form-group">
            <label class="form-label">Altテキスト（画像の説明）</label>
            <input type="text" name="alt_text" class="sh-input" placeholder="画像が表示されない時のテキスト">
        </div>

        <button type="submit" class="btn-save">バナーを登録する</button>
    </form>
    
    <div style="text-align: center; margin-top: 20px;">
        <a href="<?= site_url('admin/banner/') ?>" style="color: #95a5a6; text-decoration: none; font-size: 0.9rem;">← 一覧に戻る</a>
    </div>
</div>

<script>
    // 画像選択時にプレビューを表示するシュッとしたJavaScript
    document.getElementById('banner-image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('image-preview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}">`;
            }
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '<span style="color: #999;">画像を選択するとプレビューが表示されます</span>';
        }
    });
</script>
<?= $this->endSection() ?>