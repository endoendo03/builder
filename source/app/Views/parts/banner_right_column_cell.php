<?php if (!empty($banners)): ?>
    <div class="side-banner-list">
        <?php foreach ($banners as $b): ?>
            <div class="side-banner-item" style="margin-bottom: 15px;">
                <a href="<?= esc($b['link_url'] ?: 'javascript:void(0)') ?>">
                    <img src="<?= base_url($b['image_path']) ?>" 
                         alt="<?= esc($b['alt_text']) ?>" 
                         style="width: 100%; height: auto; border: 1px solid #333; border-radius: 4px; display: block; transition: 0.3s;">
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>