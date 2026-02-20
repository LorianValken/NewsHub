<?php include('header.php'); ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-color: #e63946; /* Modern Red */
        --dark-bg: #1d3557;
        --light-bg: #f8f9fa;
        --text-dark: #111827;
        --text-muted: #6b7280;
        --card-radius: 12px;
        --transition: all 0.3s ease;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--light-bg);
        color: var(--text-dark);
        overflow-x: hidden;
    }

    /* --- Trending Ticker (Replaces Marquee) --- */
    .trending-wrapper {
        background: #fff;
        border-bottom: 1px solid #e5e7eb;
        padding: 0;
        height: 50px;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .trending-label {
        background-color: var(--primary-color);
        color: white;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        padding: 0 20px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
        position: relative;
        z-index: 9;
    }

    .trending-label::after {
        content: '';
        position: absolute;
        right: -20px;
        top: 0;
        border-top: 50px solid var(--primary-color);
        border-right: 20px solid transparent; 
        /* Angled edge effect */
    }

    .ticker-container {
        flex-grow: 1;
        overflow: hidden;
        white-space: nowrap;
        position: relative;
    }

    .ticker-content {
        display: inline-block;
        animation: ticker 30s linear infinite;
        padding-left: 20px;
    }

    .ticker-content a {
        color: var(--text-dark);
        text-decoration: none;
        margin-right: 30px;
        font-weight: 500;
        font-size: 0.95rem;
    }
    
    .ticker-content a:hover {
        color: var(--primary-color);
        text-decoration: underline;
    }

    @keyframes ticker {
        0% { transform: translateX(0); }
        100% { transform: translateX(-100%); }
    }

    /* --- Hero / Latest News Section --- */
    .latest-news {
        padding: 40px 0;
    }

    /* Styling for content injected by PHP functions */
    .content-left img, .content-right img {
        border-radius: var(--card-radius);
        width: 100%;
        object-fit: cover;
    }

    /* --- Section Headers --- */
    .modern-header {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
        position: relative;
    }

    .modern-header::after {
        content: '';
        flex-grow: 1;
        height: 2px;
        background: #e5e7eb;
        margin-left: 15px;
    }

    .header-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--text-dark);
        text-transform: uppercase;
        position: relative;
        padding-left: 15px;
        border-left: 5px solid var(--primary-color);
        line-height: 1;
    }

    /* --- General News Grid Styles --- */
    /* This targets the PHP output inside .news .row */
    .news .row > div {
        margin-bottom: 30px;
    }

    /* Assuming your PHP generates cards or divs, we apply generic card styling */
    .news img {
        border-radius: var(--card-radius);
        transition: var(--transition);
        width: 100%;
        height: 220px; /* Fixed height for consistency */
        object-fit: cover;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .news div:hover img {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .news h3, .news h4, .news a {
        text-decoration: none !important;
        color: var(--text-dark);
        font-weight: 700;
        margin-top: 10px;
        display: block;
        transition: color 0.2s;
    }

    .news a:hover {
        color: var(--primary-color);
    }

    /* Mobile adjustments */
    @media (max-width: 768px) {
        .trending-label {
            font-size: 0.7rem;
            padding: 0 10px;
        }
        .trending-label::after { display: none; }
        .ticker-content { animation: ticker 15s linear infinite; }
    }
</style>

<main>
    <section class="trending-wrapper">
        <div class="trending-label">
            <i class="fas fa-bolt me-2"></i> Trending Now
        </div>
        <div class="ticker-container">
            <div class="ticker-content" onmouseover="this.style.animationPlayState='paused'" onmouseout="this.style.animationPlayState='running'">
                <?php get_trending_news(); ?>
            </div>
        </div>
    </section>
      
    <section class="latest-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 content-left mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <?php main_popular_news() ?>
                        </div>
                </div>
                <div class="col-lg-4 col-md-12 content-right">
                    <div class="row g-3">
                        <?php sub_main_popular_news() ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="category-section py-4">
        <div class="container">
            <div class="modern-header">
                <div class="header-title">Sport News</div>
            </div>
            <div class="news">
                <div class="row">
                    <?php get_latest_news('sport') ?>
                </div>
            </div>
        </div>
    </section>

    <section class="category-section py-4 bg-white">
        <div class="container">
            <div class="modern-header">
                <div class="header-title">Social News</div>
            </div>
            <div class="news">
                <div class="row">
                    <?php get_latest_news('social') ?>
                </div>
            </div>
        </div>
    </section>
    
    <section class="category-section py-4">
        <div class="container">
            <div class="modern-header">
                <div class="header-title">Entertainment</div>
            </div>
            <div class="news">
                <div class="row">
                    <?php get_latest_news('entertainment') ?>
                </div>
            </div>
        </div>
    </section>

</main>

<?php include('footer.php'); ?>