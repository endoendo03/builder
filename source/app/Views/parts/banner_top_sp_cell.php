<?php if (!empty($banners)): ?>
    <div class="swiper-container sh-banner-sp">
        <div class="swiper-wrapper">
            <?php foreach ($banners as $b): ?>
                <div class="swiper-slide">
                    <a href="<?= esc($b['link_url'] ?: 'javascript:void(0)') ?>">
                        <img src="<?= base_url($b['image_path']) ?>" 
                             alt="<?= esc($b['alt_text']) ?>" 
                             style="width: 100%; height: auto; display: block;">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
<?php endif; ?>