<?php include('header.php'); ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-color: #27306D;
        --accent-color: #e63946;
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
    .search-header {
        background: #fff;
        padding: 50px 0;
        margin-bottom: 40px;
        border-bottom: 1px solid #eee;
        text-align: center;
    }

    .header-title {
        font-size: 2.2rem;
        font-weight: 800;
        text-transform: uppercase;
        color: var(--primary-color);
        margin-bottom: 10px;
        letter-spacing: -0.5px;
    }

    .search-query-text {
        color: var(--accent-color);
        font-style: italic;
    }

    /* --- News Grid Styling --- */
    .news-grid .row > div {
        margin-bottom: 30px;
    }

    /* Generic styles targeting PHP output from search_news() */
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
        text-decoration: none !important;
        color: var(--text-dark);
        font-weight: 700;
        font-size: 1.1rem;
        margin-top: 15px;
        display: block;
        line-height: 1.4;
        transition: color 0.2s;
    }

    .news-grid a:hover {
        color: var(--accent-color);
    }

    @media (max-width: 768px) {
        .header-title { font-size: 1.6rem; }
        .search-header { padding: 35px 0; }
    }
</style>

<main class="search-page">
    <section class="search-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="header-title">Search Results</h1>
                    <p class="text-muted">Showing results for: <span class="search-query-text">"<?php echo htmlspecialchars($_GET['query'] ?? ''); ?>"</span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="content news-grid pb-5">
        <div class="container">
            <div class="row">
                <?php 
                    $query = $_GET['query'];
                    search_news($query);
                ?>
            </div>
        </div>
    </section>
</main>

<?php include('footer.php'); ?>