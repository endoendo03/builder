<div class="raw-video-grid">
    <?php 
    foreach ($displayVideos as $v): 
    ?>
        <div class="video-card">
            <a href="<?= esc($v['url']) ?>" class="video-link" target="_blank">
                <div class="video-thumb-wrap">
                    <img src="<?= esc($v['thumbnail_url']) ?>" alt="<?= esc($v['title']) ?>" loading="lazy">
                    
                    <span class="view-count">
                        <i class="icon-eye">👁️</i> <?= number_format($v['view_count']) ?> views
                    </span>

                    <?php if (!empty($v['girls'])): ?>
                        <span class="cast-tag">
                            <?= esc($v['girls'][0]['name']) ?>(<?= esc($v['girls'][0]['age']) ?>)
                        </span>
                    <?php endif; ?>

                    <div class="play-btn"></div>
                </div>

                <div class="video-meta">
                    <div class="video-title"><?= esc($v['title']) ?></div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<div class="btn-area" style="margin-top: 25px; text-align: center;">
    <a href="https://purelovers.com/shpo/<?php echo PURELOVERS_SHOP_ID;?>/movie/" target="_blank" class="sh-btn-gold" style="display: inline-block; padding: 12px 40px; text-decoration: none;">
        生動画をもっと見る
    </a>
</div>

<style>
    .raw-video-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .video-card {
        width: calc(50% - 10px); /* PC・スマホ共に2列が動画は見やすい */
        background: #1a1a1a;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #333;
        transition: 0.3s;
    }

    .video-card:hover {
        border-color: #d4af37;
        transform: translateY(-3px);
    }

    .video-thumb-wrap {
        position: relative;
        aspect-ratio: 4 / 3;
        overflow: hidden;
        background: #000;
    }

    .video-thumb-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s;
    }

    /* 再生ボタン中央 */
    .play-btn {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: 50px; height: 50px;
        background: rgba(212, 175, 55, 0.8);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0.8;
    }
    .play-btn::after {
        content: "";
        display: block;
        border-style: solid;
        border-width: 10px 0 10px 18px;
        border-color: transparent transparent transparent #fff;
        margin-left: 5px;
    }

    /* ビュー数・キャスト名 */
    .view-count {
        position: absolute;
        top: 8px; left: 8px;
        background: rgba(0,0,0,0.7);
        color: #fff;
        font-size: 10px;
        padding: 2px 8px;
        border-radius: 4px;
    }

    .cast-tag {
        position: absolute;
        bottom: 8px; right: 8px;
        background: #f00; /* なまれんレッド */
        color: #fff;
        font-size: 11px;
        font-weight: bold;
        padding: 2px 10px;
        border-radius: 20px;
    }

    /* タイトル */
    .video-meta { padding: 10px; }
    .video-title {
        color: #ddd;
        font-size: 0.85rem;
        line-height: 1.4;
        height: 2.8em; /* 2行分確保 */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .video-card:hover .video-thumb-wrap img {
        filter: brightness(1.2) scale(1.1);
    }
</style>