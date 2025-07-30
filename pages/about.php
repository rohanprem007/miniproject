<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - TravelEase</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="page-style.css">
</head>
<body>

    

     <header class="header">
        <div class="container">
            <nav class="header-nav">
                <a href="../webpage/index.php" class="logo">TravelEase</a>
                <div class="nav-links">
                    <a href="../pages/packages.php">Package</a>
                    <a href="../pages/booking.php">Booking</a>
                    <a href="../pages/payment.php">Payment</a>
                    <a href="../pages/about.php">About Us</a>
                </div>
                <div class="nav-right">
                    <a href="#" class="signin-btn">Sign in</a>
                    <a href="#" class="signup-btn">Sign up</a>
                    <div class="menu-toggle">
                        <!-- A simple hamburger icon -->
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H20" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
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
