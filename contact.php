<?php include('header.php'); ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

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
    }

    /* --- Page Header --- */
    .contact-header {
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

    .header-title::after {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background: var(--accent-color);
        margin: 15px auto 0;
        border-radius: 2px;
    }

    /* --- Contact Cards --- */
    .contact-card {
        background: #fff;
        padding: 30px;
        border-radius: var(--border-radius);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        height: 100%;
        margin-bottom: 30px;
    }

    .card-title {
        font-weight: 800;
        color: var(--primary-color);
        margin-bottom: 25px;
        font-size: 1.25rem;
        border-left: 4px solid var(--accent-color);
        padding-left: 15px;
    }

    /* Follow List */
    .follow-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .follow-list li {
        display: flex;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .follow-list li:last-child { border-bottom: none; }

    .follow-list img {
        width: 32px;
        height: 32px;
        margin-right: 15px;
        object-fit: contain;
    }

    .follow-list a {
        color: var(--text-dark);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
    }

    .follow-list a:hover { color: var(--accent-color); }

    /* Form Styling */
    .form-label {
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(39, 48, 109, 0.1);
        outline: none;
    }

    .btn-send {
        background-color: var(--primary-color);
        color: #fff;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: var(--transition);
        width: 100%;
    }

    .btn-send:hover {
        background-color: #1a214d;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(39, 48, 109, 0.2);
    }

    @media (max-width: 768px) {
        .header-title { font-size: 1.8rem; }
        .contact-header { padding: 40px 0; }
        .contact-card { padding: 20px; }
    }
</style>

<main class="contact-page">
    <section class="contact-header">
        <div class="container">
            <h1 class="header-title">Contact Us</h1>
            <p class="text-muted">Have questions or feedback? We'd love to hear from you.</p>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="contact-card">
                        <h4 class="card-title">FOLLOW US</h4>
                        <ul class="follow-list">
                            <li><a href="#"><img src="assets/image/facebook.png" alt="Facebook">Facebook</a></li>
                            <li><a href="#"><img src="assets/image/youtube.png" alt="Youtube">Youtube</a></li>
                            <li><a href="#"><img src="assets/image/instagram.png" alt="Instagram">Instagram</a></li>
                            <li><a href="#"><img src="assets/image/tik.png" alt="Tiktok">TikTok</a></li>
                            <li><a href="#"><img src="assets/image/gmail.png" alt="Gmail">Gamil</a></li>
                            <li><a href="#"><img src="assets/image/tel.png" alt="Telegram">Telegram</a></li>
                            <li><a href="#"><img src="assets/image/phone.png" alt="Phone">Phone : 081 640 629</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="contact-card">
                        <h4 class="card-title">FEEDBACK TO US</h4>
                        <form action="" method="post">
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Telephone</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Your Address" required>
                                </div>
                                <div class="col-12 mb-4">
                                    <label class="form-label">Message</label>
                                    <textarea name="message" class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" name="btn_message" class="btn-send">
                                        <i class="fab fa-telegram-plane me-2"></i> Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include('footer.php'); ?>