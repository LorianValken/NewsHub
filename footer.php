<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Style Footer</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;1,300&family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">

    <style>
        /* --- RESET & VARIABLES --- */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --news-bg: #121212;         /* Very Dark, almost black (High Contrast) */
            --news-text: #dcdcdc;       /* Light Gray for readability */
            --news-accent: #cc0000;     /* "Breaking News" Red */
            --news-border: #333333;     /* Subtle separator lines */
        }

        body {
            font-family: 'Roboto Condensed', sans-serif;
        }

        /* --- FOOTER CONTAINER --- */
        footer {
            background-color: var(--news-bg);
            color: var(--news-text);
            padding: 50px 0;
            width: 100%;
            border-top: 4px solid var(--news-accent); /* The "News" Accent Line */
            font-size: 15px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: flex-start; /* Align to top for a structured grid look */
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 40px;
        }

        /* --- LOGO SECTION --- */
        .footer-logo {
            flex: 0 0 auto;
            border-right: 1px solid var(--news-border); /* Editorial vertical divider */
            padding-right: 40px;
            height: 100%;
        }

        .footer-logo img {
            width: 90px;
            height: 90px;
            object-fit: contain; /* Keeps logo crisp */
            /* No border radius - News logos are usually square/rectangular */
        }

        /* --- ABOUT / TEXT SECTION --- */
        .footer-about {
            flex: 1;
            max-width: 550px;
            padding-right: 20px;
        }

        /* THE "NEWS" VIBE: Serif Font for text */
        .footer-about p {
            font-family: 'Merriweather', serif; /* Editorial Font */
            font-weight: 300;
            line-height: 1.8;
            color: #b0b0b0;
            font-style: italic; /* Slight italic for that "Editor's Note" feel */
        }

        /* --- SOCIAL ICONS SECTION --- */
        .footer-connect {
            flex: 0 0 auto;
            display: flex;
            flex-direction: column;
            align-items: flex-end; /* Align right for desktop */
        }

        .connect-label {
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 2px;
            color: #666;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .social-list {
            display: flex;
            list-style: none;
            gap: 10px;
        }

        .social-list li a {
            display: flex;
            width: 40px;
            height: 40px;
            background: #222; /* darker box for icons */
            align-items: center;
            justify-content: center;
            border: 1px solid #333; /* Thin border */
            transition: all 0.2s ease;
        }

        .social-list li a img {
            width: 18px;
            height: 18px;
            filter: grayscale(100%) brightness(150%);
            transition: all 0.2s ease;
        }

        /* Hover Effects - Sharp and Professional */
        .social-list li a:hover {
            background: var(--news-accent);
            border-color: var(--news-accent);
        }

        .social-list li a:hover img {
            filter: grayscale(0) brightness(200%);
        }

        /* --- RESPONSIVE MOBILE --- */
        @media (max-width: 900px) {
            .container {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 30px;
            }

            .footer-logo {
                border-right: none; /* Remove divider on mobile */
                padding-right: 0;
                border-bottom: 1px solid var(--news-border);
                padding-bottom: 20px;
                width: 100%;
                display: flex;
                justify-content: center;
            }

            .footer-connect {
                align-items: center; /* Center socials on mobile */
            }
        }
    </style>
</head>
<body>

    <footer>
        <div class="container">
            
            <div class="footer-logo">
                <a href="#">
                    <img src="admin/assets/image/<?php echo basename(get_website_logo('footer')); ?>" alt="News Logo">
                </a>
            </div>

            <div class="footer-about">
                <p>
                    "We deliver the latest breaking news, in-depth analysis, and trusted stories from around the world. 
                    Our mission is to provide accurate, timely, and reliable information."
                </p>
            </div>

            <div class="footer-connect">
                <span class="connect-label">Follow Us</span>
                <ul class="social-list">
                    <li>
                        <a href="#"><img src="assets/image/fb.png" alt="Facebook"></a>
                    </li>
                    <li>
                        <a href="#"><img src="assets/image/tik.png" alt="TikTok"></a>
                    </li>
                    <li>
                        <a href="#"><img src="assets/image/tel.png" alt="Telegram"></a>
                    </li>
                </ul>
            </div>

        </div>
    </footer>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="assets/script/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
</html>