<form action="/admin/banners/store" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="form-group">
        <label>バナー名（管理用）</label>
        <input type="text" name="title" class="form-control" placeholder="夏キャンペーン用">
    </div>

    <div class="form-group">
        <label>画像の説明（ALT属性）</label>
        <input type="text" name="alt_text" class="form-control" placeholder="新人キャスト多数在籍！人妻レンタルNTR">
        <small>※SEOに影響します。バナーに書かれている文字を入力してください。</small>
    </div>

    <div class="form-group">
        <label>PC用バナー (推奨: 1920x600など)</label>
        <input type="file" name="pc_image" accept="image/*" required>
    </div>

    <div class="form-group">
        <label>スマホ用バナー (推奨: 800x800など)</label>
        <input type="file" name="sp_image" accept="image/*" required>
    </div>

    <div class="form-group">
        <label>リンク先URL</label>
        <input type="text" name="link_url" placeholder="https://...">
    </div>

    <button type="submit" class="btn-primary">保存する</button>
</form>