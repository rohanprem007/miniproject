<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - TravelEase</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../webpage/style.css">
    <link rel="stylesheet" href="page-style.css">
</head>
<body>
    <header class="header scrolled">
        <div class="container">
            <nav class="header-nav">
                <a href="../webpage/index.php" class="logo">TravelEase</a>
                <div class="nav-links">
                    <a href="packages.php">Package</a>
                    <a href="booking.php">Booking</a>
                    <a href="about.php">About Us</a>
                </div>
                <div class="nav-right">
                    <div class="dropdown">
                        <button class="signin-btn" id="signInBtn">
                            Sign in
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-left: 4px;"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
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
    <main class="page-main">
        <section class="page-header">
            <div class="container">
                <h1>About TravelEase</h1>
                <p>Crafting unforgettable travel experiences since 2024.</p>
            </div>
        </section>
        <section class="page-content">
            <div class="container content-container">
                <h2>Our Mission</h2>
                <p>At TravelEase, our mission is to simplify tourism management for both agencies and travelers. We believe that planning a trip should be as exciting as the journey itself. Our platform is designed to provide a seamless, intuitive, and efficient way to explore, book, and manage travel, eliminating hassle and enhancing the overall experience.</p>
                
                <h2>Our Story</h2>
                <p>Founded by a team of passionate travelers and tech enthusiasts, TravelEase was born from a desire to solve the common challenges faced in the tourism industry. We saw a need for a centralized, digital solution that could streamline operations for travel agencies while offering a user-friendly interface for customers. Today, we are proud to offer a robust platform that empowers businesses and delights travelers.</p>

                <h2>Why Choose Us?</h2>
                <ul>
                    <li><strong>Expertly Curated Packages:</strong> We partner with the best to offer unique and memorable travel packages.</li>
                    <li><strong>User-Friendly Platform:</strong> Our website is easy to navigate, making booking a breeze.</li>
                    <li><strong>Secure and Reliable:</strong> We prioritize the security of your data and transactions.</li>
                    <li><strong>Dedicated Support:</strong> Our team is always here to help you with any inquiries or issues.</li>
                </ul>
            </div>
        </section>
    </main>
    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> TravelEase. All Rights Reserved.</p>
        </div>
    </footer>
    <script src="../webpage/script.js"></script>
</body>
</html>
