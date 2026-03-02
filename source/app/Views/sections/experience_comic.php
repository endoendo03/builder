<div class="exp-manga-grid">
    <?php foreach ($exp_comic as $c): ?>
        <div class="manga-item">
            <a href="<?= esc($c['url']) ?>" target="_blank" class="manga-link">
                <div class="manga-thumb-wrap">
                    <img src="<?= esc($c['thumbnail']) ?>" alt="体験漫画" loading="lazy">
                    
                    <div class="manga-overlay">
                        <span class="manga-badge">CLICK TO READ</span>
                    </div>
                </div>
                
                <div class="manga-label">
                    <span class="icon">📖</span> EXPERIENCE MANGA
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<style>
    .exp-manga-grid {
        display: flex;
        justify-content: center;
        padding: 0 10px;
    }

    .manga-item {
        width: 100%;
        max-width: 500px; /* 漫画は少し存在感を出したい */
        perspective: 1000px; /* ホバー時の奥行き用 */
    }

    .manga-link {
        text-decoration: none;
        display: block;
    }

    .manga-thumb-wrap {
        position: relative;
        border: 3px solid #333;
        border-radius: 12px;
        overflow: hidden;
        background: #111;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        transition: 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .manga-thumb-wrap img {
        width: 100%;
        height: auto;
        display: block;
        transition: 0.5s;
    }

    /* 漫画専用オーバーレイ */
    .manga-overlay {
        position: absolute;
        bottom: 0; left: 0; width: 100%;
        height: 40%;
        background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding-bottom: 20px;
        opacity: 0.8;
        transition: 0.3s;
    }

    .manga-badge {
        background: #f00; /* なまれんレッド */
        color: #fff;
        font-size: 0.75rem;
        font-weight: bold;
        padding: 4px 15px;
        border-radius: 4px;
        letter-spacing: 1px;
    }

    /* ホバー演出：本を開くような少しの傾き */
    .manga-link:hover .manga-thumb-wrap {
        border-color: #d4af37;
        transform: rotateY(-5deg) translateY(-5px);
        box-shadow: 0 15px 40px rgba(212, 175, 55, 0.3);
    }

    .manga-link:hover .manga-thumb-wrap img {
        filter: brightness(1.2);
    }

    .manga-link:hover .manga-badge {
        background: #d4af37;
        color: #000;
    }

    .manga-label {
        text-align: center;
        color: #d4af37;
        font-size: 0.9rem;
        margin-top: 15px;
        letter-spacing: 2px;
        font-weight: bold;
        font-family: serif;
    }
    .manga-label .icon { margin-right: 5px; }
</style>