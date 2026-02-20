<!DOCTYPE html>
<?php 
if (session_status() === PHP_SESSION_NONE) session_start(['cookie_path' => '/']);
include('function.php'); 
?>
<html lang="en">

<head>
    <title>CMS News</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Kantumruy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/sport.css">
    <link rel="stylesheet" href="assets/css/news-detail.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <link rel="stylesheet" href="assets/css/search.css">

    <style>
        /* --- General Header Styling --- */
        body {
            font-family: 'Roboto', sans-serif;
            padding-top: 100px;
            transition: margin-left 0.3s;
            overflow-x: hidden;
        }

        header {
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 5px 0;
        }

        /* --- Logo Styling --- */
        .navbar-brand img {
            max-height: 70px;
            width: auto;
            transition: 0.3s;
        }

        /* --- Menu Links (Horizontal - Simplified) --- */
        .navbar-nav .nav-link {
            font-weight: 600;
            color: #222 !important;
            padding: 10px 15px !important;
            text-transform: uppercase;
            font-size: 14px;
            transition: color 0.3s;
        }

        .navbar-nav .nav-item:hover > .nav-link {
            color: #e74c3c !important;
        }

        /* Show dropdown on hover for desktop */
        @media (min-width: 992px) {
            .navbar-nav .nav-item.dropdown:hover > .dropdown-menu {
                display: block !important;
                margin-top: 0;
                border: none;
                box-shadow: 0 8px 15px rgba(0,0,0,0.1);
                border-radius: 0 0 8px 8px;
            }
            .navbar-nav .dropdown-menu .dropdown-item {
                font-size: 13px;
                font-weight: 600;
                padding: 10px 20px;
                text-transform: uppercase;
            }
            .navbar-nav .dropdown-menu .dropdown-item:hover {
                background-color: #f8f9fa;
                color: #e74c3c;
            }
        }

        /* --- Search Bar Styling (Hidden on mobile, shown in sidebar) --- */
        .search-container {
            position: relative;
            margin-left: 15px;
        }

        .search-form {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-form input {
            padding: 8px 15px;
            padding-right: 35px;
            border-radius: 20px;
            border: 1px solid #ddd;
            outline: none;
            font-size: 14px;
            width: 220px;
            transition: border-color 0.3s;
        }

        .search-form input:focus {
            border-color: #e74c3c;
        }

        .search-form button {
            position: absolute;
            right: 10px;
            background: none;
            border: none;
            color: #888;
            cursor: pointer;
        }

        /* Hide desktop search on mobile */
        @media (max-width: 991px) {
            .search-container {
                display: none;
            }
        }

        /* --- Sidebar Menu Button --- */
        .sidebar-menu-btn {
            background: none;
            border: none;
            font-size: 24px;
            color: #333;
            cursor: pointer;
            margin-right: 15px;
        }

        .sidebar-menu-btn:hover {
            color: #e74c3c;
        }

        /* Hide sidebar button on desktop */
        @media (min-width: 992px) {
            .sidebar-menu-btn {
                display: none;
            }
        }

        /* --- Sidebar Menu --- */
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1002;
            top: 0;
            left: 0;
            background-color: #fff;
            overflow-x: hidden;
            transition: 0.3s;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            padding-top: 80px;
        }

        .sidebar.open {
            width: 300px;
        }

        .sidebar .sidebar-header {
            position: absolute;
            top: 0;
            width: 100%;
            padding: 15px 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar .sidebar-header h3 {
            margin: 0;
            font-size: 20px;
            color: #333;
            font-weight: 600;
        }

        .sidebar .close-btn {
            font-size: 28px;
            cursor: pointer;
            color: #666;
            line-height: 1;
        }

        .sidebar .close-btn:hover {
            color: #e74c3c;
        }

        /* Sidebar Search Box */
        .sidebar-search {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .sidebar-search-form {
            position: relative;
            width: 100%;
        }

        .sidebar-search-form input {
            width: 100%;
            padding: 12px 15px;
            padding-right: 45px;
            border: 2px solid #eee;
            border-radius: 30px;
            font-size: 15px;
            transition: all 0.3s;
            background: #f9f9f9;
        }

        .sidebar-search-form input:focus {
            border-color: #e74c3c;
            background: #fff;
            outline: none;
        }

        .sidebar-search-form button {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #e74c3c;
            font-size: 18px;
            cursor: pointer;
        }

        .sidebar-search-form button:hover {
            color: #c0392b;
        }

        .sidebar .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar .sidebar-nav .nav-item {
            border-bottom: 1px solid #f0f0f0;
        }

        .sidebar .sidebar-nav .nav-link {
            display: block;
            padding: 15px 20px;
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            position: relative;
        }

        .sidebar .sidebar-nav .nav-link:hover {
            background-color: #f8f9fa;
            color: #e74c3c;
            padding-left: 25px;
        }

        .sidebar .sidebar-nav .nav-link i {
            margin-right: 12px;
            width: 22px;
            color: #e74c3c;
            font-size: 16px;
        }

        /* Sidebar Dropdown */
        .sidebar .dropdown-sidebar {
            position: relative;
        }

        .sidebar .dropdown-sidebar > .nav-link {
            position: relative;
            padding-right: 40px;
        }

        .sidebar .dropdown-sidebar > .nav-link:after {
            content: '\f107';
            font-family: 'Font Awesome 5 Pro';
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            transition: transform 0.3s;
            color: #999;
        }

        .sidebar .dropdown-sidebar.open > .nav-link:after {
            transform: translateY(-50%) rotate(180deg);
            color: #e74c3c;
        }

        .sidebar .dropdown-sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            background-color: #f8f9fa;
            display: none;
        }

        .sidebar .dropdown-sidebar.open .dropdown-sidebar-menu {
            display: block;
        }

        .sidebar .dropdown-sidebar-menu .dropdown-item {
            padding: 12px 20px 12px 52px;
            color: #555;
            text-decoration: none;
            display: block;
            font-size: 14px;
            transition: all 0.3s;
            border-bottom: 1px solid #e9e9e9;
        }

        .sidebar .dropdown-sidebar-menu .dropdown-item:hover {
            background-color: #fff;
            color: #e74c3c;
            padding-left: 57px;
        }

        .sidebar .dropdown-sidebar-menu .dropdown-item i {
            margin-right: 10px;
            width: 18px;
            color: #999;
            font-size: 14px;
        }

        .sidebar .dropdown-sidebar-menu .dropdown-item:hover i {
            color: #e74c3c;
        }

        .sidebar .dropdown-sidebar-menu .dropdown-item:last-child {
            border-bottom: none;
        }

        /* Special styling for admin link */
        .sidebar .nav-item.admin .nav-link {
            color: #e74c3c !important;
            font-weight: 700;
            border-top: 1px solid #f0f0f0;
            margin-top: 10px;
        }

        .sidebar .nav-item.admin .nav-link i {
            color: #e74c3c;
        }

        /* Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 1001;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* --- MOBILE RESPONSIVE TWEAKS --- */
        @media (max-width: 991px) {
            /* Show sidebar button */
            .sidebar-menu-btn {
                display: block;
            }
            
            /* Hide horizontal menu completely */
            .navbar-collapse {
                display: none !important;
            }
            
            /* Adjust header for mobile */
            .navbar {
                justify-content: flex-start;
            }
            
            .navbar-brand {
                margin-right: auto;
            }
            
            /* Fix Logo size on mobile */
            .navbar-brand img {
                max-height: 50px;
            }

            /* Adjust sidebar for mobile */
            .sidebar.open {
                width: 85%;
                max-width: 320px;
            }
        }

        /* Desktop view adjustments */
        @media (min-width: 992px) {
            /* Simplify horizontal menu - remove dropdown indicators */
            .nav-item.dropdown {
                position: relative;
            }
            
            /* Hide any remaining dropdown elements */
            .dropdown-toggle::after {
                display: none !important;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light px-0">
                
                <!-- Sidebar Menu Button (visible on mobile) -->
                <button class="sidebar-menu-btn" id="sidebarMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
                
                <a class="navbar-brand" href="index.php">
                    <img src="admin/assets/image/<?php echo basename(get_website_logo('header')); ?>" alt="CMS Logo">
                </a>

                <!-- Horizontal Menu (simplified - no dropdowns) -->
                <div class="collapse navbar-collapse" id="mainMenu">
                    <ul class="navbar-nav ml-auto align-items-lg-center">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">HOME</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#">SPORT</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="sport-news-national.php">National</a>
                                <a class="dropdown-item" href="sport-news-international.php">International</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#">SOCIAL</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="social-news-national.php">National</a>
                                <a class="dropdown-item" href="social-news-international.php">International</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#">ENTERTAINMENT</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="entertainment-news-national.php">National</a>
                                <a class="dropdown-item" href="entertainment-news-international.php">International</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">CONTACT</a>
                        </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['id'])): ?>
                                <a class="nav-link" href="admin/index.php" style="color: #e74c3c !important; font-weight: 700;">ADMIN</a>
                            <?php else: ?>
                                <a class="nav-link" href="admin/login.php">LOGIN</a>
                            <?php endif; ?>
                        </li>
                    </ul>

                    <!-- Desktop Search -->
                    <div class="search-container">
                        <form class="search-form" action="search.php" method="get">
                            <?php
                                $query = '';
                                if (isset($_GET['query'])) {
                                    $query = htmlspecialchars($_GET['query']);
                                }
                            ?>
                            <input type="text" name="query" placeholder="Search..." value="<?= $query ?>">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Sidebar Menu with Search Box and Dropdowns -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-menu" style="margin-right: 10px; color: #e74c3c;"></i>Menu</h3>
            <span class="close-btn" id="closeSidebar">&times;</span>
        </div>
        
        <!-- Search Box in Sidebar -->
        <div class="sidebar-search">
            <form class="sidebar-search-form" action="search.php" method="get">
                <?php
                    $query = '';
                    if (isset($_GET['query'])) {
                        $query = htmlspecialchars($_GET['query']);
                    }
                ?>
                <input type="text" name="query" placeholder="Search news..." value="<?= $query ?>">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        
        <ul class="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-home"></i> HOME
                </a>
            </li>
            
            <li class="nav-item dropdown-sidebar" id="sportDropdownSidebar">
                <a class="nav-link" href="#">
                    <i class="fas fa-futbol"></i> SPORT
                </a>
                <ul class="dropdown-sidebar-menu">
                    <li><a class="dropdown-item" href="sport-news-national.php"><i class="fas fa-flag"></i> National</a></li>
                    <li><a class="dropdown-item" href="sport-news-international.php"><i class="fas fa-globe"></i> International</a></li>
                </ul>
            </li>
            
            <li class="nav-item dropdown-sidebar" id="socialDropdownSidebar">
                <a class="nav-link" href="#">
                    <i class="fas fa-users"></i> SOCIAL
                </a>
                <ul class="dropdown-sidebar-menu">
                    <li><a class="dropdown-item" href="social-news-national.php"><i class="fas fa-flag"></i> National</a></li>
                    <li><a class="dropdown-item" href="social-news-international.php"><i class="fas fa-globe"></i> International</a></li>
                </ul>
            </li>
            
            <li class="nav-item dropdown-sidebar" id="entDropdownSidebar">
                <a class="nav-link" href="#">
                    <i class="fas fa-film"></i> ENTERTAINMENT
                </a>
                <ul class="dropdown-sidebar-menu">
                    <li><a class="dropdown-item" href="entertainment-news-national.php"><i class="fas fa-flag"></i> National</a></li>
                    <li><a class="dropdown-item" href="entertainment-news-international.php"><i class="fas fa-globe"></i> International</a></li>
                </ul>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="contact.php">
                    <i class="fas fa-envelope"></i> CONTACT
                </a>
            </li>
            
            <li class="nav-item admin">
                <?php if(isset($_SESSION['id'])): ?>
                    <a class="nav-link" href="admin/index.php">
                        <i class="fas fa-lock"></i> ADMIN PANEL
                    </a>
                <?php else: ?>
                    <a class="nav-link" href="admin/login.php">
                        <i class="fas fa-sign-in-alt"></i> LOGIN
                    </a>
                <?php endif; ?>
            </li>
        </ul>
    </div>

    <!-- Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="container">
        <!-- Your main content here -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

    <script>
        $(document).ready(function() {
            // Sidebar functionality
            var sidebar = $('#sidebar');
            var overlay = $('#sidebarOverlay');
            var menuBtn = $('#sidebarMenuBtn');
            var closeBtn = $('#closeSidebar');
            
            // Open sidebar
            menuBtn.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                sidebar.addClass('open');
                overlay.addClass('active');
                $('body').css('overflow', 'hidden'); // Prevent body scrolling
            });
            
            // Close sidebar functions
            function closeSidebar() {
                sidebar.removeClass('open');
                overlay.removeClass('active');
                $('body').css('overflow', ''); // Restore body scrolling
            }
            
            closeBtn.on('click', closeSidebar);
            overlay.on('click', closeSidebar);
            
            // Close sidebar on escape key
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && sidebar.hasClass('open')) {
                    closeSidebar();
                }
            });
            
            // Sidebar dropdown functionality
            $('.dropdown-sidebar > .nav-link').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                var parent = $(this).parent('.dropdown-sidebar');
                
                // Close other dropdowns
                $('.dropdown-sidebar').not(parent).removeClass('open');
                
                // Toggle current dropdown
                parent.toggleClass('open');
            });
            
            // Handle window resize
            $(window).on('resize', function() {
                if ($(window).width() > 991) {
                    // Close sidebar if open on desktop
                    sidebar.removeClass('open');
                    overlay.removeClass('active');
                    $('body').css('overflow', '');
                }
            });
            
            // Close sidebar when clicking on a link (except dropdown toggles)
            $('.sidebar-nav a:not(.dropdown-sidebar > .nav-link)').on('click', function() {
                if ($(window).width() <= 991) {
                    closeSidebar();
                }
            });
            
            // Prevent sidebar from closing when clicking inside dropdown menu
            $('.dropdown-sidebar-menu .dropdown-item').on('click', function(e) {
                if ($(window).width() <= 991) {
                    closeSidebar();
                }
            });
        });
    </script>

</body>
</html>