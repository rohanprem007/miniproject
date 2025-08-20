<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelEase - Seamless Tourism Management</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- External CSS Stylesheet -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="header">
        <div class="container">
            <nav class="header-nav">
                <a href="index.php" class="logo">TravelEase</a>
                <div class="nav-links">
                    <a href="../pages/packages.php">Package</a>
                    <a href="../pages/booking.php">Booking</a>
                    <a href="../pages/about.php">About Us</a>
                </div>
                <div class="nav-right">
                    <div class="dropdown">
                        <button class="signin-btn" id="signInBtn">
                            Sign in
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-left: 4px;">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                        <div class="dropdown-menu" id="signInDropdown">
                            <a href="../user/login_page.php">User Login</a>
                            <a href="../admin/admin_login.php">Admin Login</a>
                        </div>
                    </div>
                    <a href="../user/signup_page.php" class="signup-btn">Sign up</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Hero Section with Video Background -->
        <section class="hero">
            <div class="video-background">
                <video playsinline autoplay muted loop poster="https://placehold.co/1920x1080/000000/ffffff?text=Loading+Video..." id="bg-video">
                    <source src="./video/2.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="video-overlay"></div>
            <div class="container hero-content">
                <h1>Unlock Seamless Tourism Management</h1>
                <p>Streamline your operations, enhance traveler experiences, and grow your business with our intuitive platform.</p>
                <a href="../pages/packages.php" class="cta-button">Explore Destinations</a>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features" id="features">
            <div class="container">
                <div class="features-grid">
                    <a href="../pages/packages.php" class="feature-card-link">
                        <div class="feature-card">
                            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg></div>
                            <h3>Packages</h3>
                            <p>Effortlessly plan and manage itineraries for diverse destinations.</p>
                        </div>
                    </a>
                    <a href="../pages/booking.php" class="feature-card-link">
                        <div class="feature-card">
                            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg></div>
                            <h3>Booking</h3>
                            <p>Maintain detailed customer profiles and communication history.</p>
                        </div>
                    </a>
                    <a href="../pages/about.php" class="feature-card-link">
                        <div class="feature-card">
                            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="20" x2="12" y2="10"></line><line x1="18" y1="20" x2="18" y2="4"></line><line x1="6" y1="20" x2="6" y2="16"></line></svg></div>
                            <h3>About Us</h3>
                            <p>Gain insights with comprehensive reports on your business performance.</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> TravelEase. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>

</body>
</html>
