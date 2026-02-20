<?php include('header.php'); ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-color: #27306D; 
        --social-accent: #10b981; /* Green accent */
        --bg-light: #f8f9fa;
        --text-dark: #111827;
        --border-radius: 12px;
        --transition: all 0.3s ease;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--bg-light);
        color: var(--text-dark);
    }

    /* --- Page Header Section --- */
    .page-header {
        background: #fff;
        padding: 60px 0;
        margin-bottom: 40px;
        border-bottom: 1px solid #eee;
        text-align: center;
    }

    .header-title {
        font-size: 2.5rem;
        font-weight: 800;
        text-transform: uppercase;
        color: var(--primary-color);
        margin-bottom: 10px;
        letter-spacing: -1px;
    }

    .header-subtitle {
        color: #6b7280;
        font-size: 1rem;
        font-weight: 500;
        max-width: 600px;
        margin: 0 auto;
        position: relative;
    }

    .header-subtitle::after {
        content: '';
        display: block;
        width: 50px;
        height: 3px;
        background: var(--social-accent); /* Green accent */
        margin: 15px auto 0;
        border-radius: 2px;
    }

    /* --- News Grid Styling --- */
    .news-grid .row > div {
        margin-bottom: 30px;
    }

    /* Generic styles targeting PHP output */
    .news-grid img {
        width: 100%;
        height: 240px;
        object-fit: cover;
        border-radius: var(--border-radius);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: var(--transition);
    }

    .news-grid div:hover img {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .news-grid h3, .news-grid a {
        text-decoration: none;
        color: var(--text-dark);
        font-weight: 700;
        font-size: 1.1rem;
        margin-top: 15px;
        display: block;
        line-height: 1.4;
        transition: color 0.2s;
    }

    .news-grid a:hover {
        color: var(--social-accent);
    }

    /* --- Pagination Styling --- */
    .pagination-container {
        margin-top: 40px;
        margin-bottom: 60px;
    }

    .pagination-list {
        display: flex;
        justify-content: center;
        gap: 8px;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .pagination-list li a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background-color: #fff;
        border: 1px solid #e5e7eb;
        color: var(--text-dark);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        font-size: 0.95rem;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    .pagination-list li a:hover {
        background-color: #f3f4f6;
        border-color: #d1d5db;
        color: var(--social-accent);
    }

    /* Active State */
    .pagination-list li a.active {
        background-color: var(--primary-color);
        color: #fff;
        border-color: var(--primary-color);
        box-shadow: 0 4px 6px rgba(39, 48, 109, 0.3);
    }

    .pagination-list li a.disabled {
        pointer-events: none;
        border: none;
        background: transparent;
        color: #9ca3af;
    }

    @media (max-width: 768px) {
        .header-title { font-size: 1.8rem; padding: 0 15px; }
        .page-header { padding: 40px 0; margin-bottom: 20px; }
        .header-subtitle { font-size: 0.9rem; padding: 0 20px; }
        .news-grid img { height: 200px; }
        .pagination-list li a { width: 38px; height: 38px; font-size: 0.85rem; }
        .pagination-container { margin-top: 20px; margin-bottom: 40px; }
    }
    @media (max-width: 576px) {
        .header-title { font-size: 1.5rem; }
        .page-header { padding: 30px 0; }
        .news-grid img { height: 180px; }
        .pagination-list li a { width: 35px; height: 35px; font-size: 0.8rem; }
        .pagination-list li.hide-mobile { display: none !important; }
    }
</style>

<main class="social-news-page">
    
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="header-title">National Sport News</h1>
                    <p class="header-subtitle">Breaking scores, athlete profiles, and match highlights from across the country.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content news-grid">
        <div class="container">
            <div class="row">
                <?php 
                    $limit  = 6;
                    $page   = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($page - 1) * $limit;
                    
                    // Note: Ensure get_post_news outputs valid Bootstrap columns (e.g., col-lg-4)
                    get_post_news('sport', 'national', $offset, $limit); 
                ?>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="pagination-container">
                        <ul class="pagination-list">
                            <?php 
                                $total_news = count_post_news('sport', 'national');
                                $total_page = ceil($total_news / $limit);

                                // Previous Button
                                if ($page > 1) {
                                    echo '<li><a href="?page='.($page - 1).'"><i class="fas fa-arrow-left"></i></a></li>';
                                }

                                // Page Numbers
                                for($i=1; $i <= $total_page; $i++) {
                                    if ($total_page > 5) {
                                        if ($i == 1 || $i == $total_page || ($i >= $page - 1 && $i <= $page + 1)) {
                                            $activeClass = ($i == $page) ? 'active' : '';
                                            echo '<li><a class="'.$activeClass.'" href="?page='.$i.'">'.$i.'</a></li>';
                                        } else if ($i == $page - 2 || $i == $page + 2) {
                                            echo '<li><a class="disabled" href="javascript:void(0)">...</a></li>';
                                        }
                                    } else {
                                        $activeClass = ($i == $page) ? 'active' : '';
                                        echo '<li><a class="'.$activeClass.'" href="?page='.$i.'">'.$i.'</a></li>';
                                    }
                                }

                                // Next Button
                                if ($page < $total_page) {
                                    echo '<li><a href="?page='.($page + 1).'"><i class="fas fa-arrow-right"></i></a></li>';
                                }
                            ?>
                        </ul>   
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php include('footer.php'); ?>