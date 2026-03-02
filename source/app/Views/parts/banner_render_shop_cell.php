<?php if (!empty($banners)): ?>
    <div class="group-shop-list">
        <?php foreach ($banners as $b): ?>
            <div class="shop-banner-item" style="margin-bottom: 15px;">
                <a href="<?= esc($b['link_url'] ?: 'javascript:void(0)') ?>" target="_blank">
                    <img src="<?= base_url($b['image_path']) ?>" 
                         alt="<?= esc($b['alt_text']) ?>" 
                         style="width: 100%; height: auto; border: 1px solid #444; border-radius: 4px; display: block; filter: grayscale(20%); transition: 0.3s;">
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>