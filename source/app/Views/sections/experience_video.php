<div class="exp-video-grid">
    <?php foreach ($exp_videos as $v): ?>
        <div class="video-item">
            <a href="<?= esc($v['url']) ?>" target="_blank" class="video-link">
                <div class="video-thumb">
                    <img src="<?= esc($v['thumbnail']) ?>" alt="体験動画">
                    <div class="play-overlay">
                        <div class="play-icon"></div>
                    </div>
                </div>
                <div class="video-label">EXPERIENCE MOVIE</div>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<style>
    .exp-video-grid {
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .video-item {
        width: 100%;
        max-width: 640px; /* サムネイルサイズに合わせる */
        position: relative;
    }

    .video-link {
        text-decoration: none;
        display: block;
    }

    .video-thumb {
        position: relative;
        border: 2px solid #333;
        border-radius: 8px;
        overflow: hidden;
        background: #000;
        aspect-ratio: 16 / 9;
    }

    .video-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: 0.5s;
    }

    /* 再生アイコン */
    .play-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
    }

    .play-icon {
        width: 0; height: 0;
        border-style: solid;
        border-width: 20px 0 20px 35px;
        border-color: transparent transparent transparent #fff;
        filter: drop-shadow(0 0 10px rgba(0,0,0,0.5));
    }

    /* ホバー時の演出 */
    .video-link:hover .video-thumb img {
        transform: scale(1.1);
        filter: brightness(1.2);
    }
    .video-link:hover .play-overlay {
        background: rgba(212, 175, 55, 0.2); /* 金色の薄い膜 */
    }

    .video-label {
        text-align: center;
        color: #d4af37;
        font-size: 0.9rem;
        margin-top: 10px;
        letter-spacing: 2px;
        font-weight: bold;
    }
</style>