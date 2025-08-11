<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - TravelEase</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../webpage/style.css">
    <link rel="stylesheet" href="page-style.css">
</head>
<body>

    <!-- Consistent Header with Dropdown -->
    <header class="header scrolled">
        <div class="container">
            <nav class="header-nav">
                <a href="../webpage/index.php" class="logo">TravelEase</a>
                <div class="nav-links">
                    <a href="packages.php">Package</a>
                    <a href="booking.php">Booking</a>
                    <a href="payment.php">Payment</a>
                    <a href="about.php">About Us</a>
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
                    <a href="#" class="signup-btn">Sign up</a>
                </div>
            </nav>
        </div>
    </header>

    <main class="page-main">
        <section class="page-header">
            <div class="container">
                <h1>Manage Your Bookings</h1>
                <p>This section is under construction. Soon you'll be able to view and manage your trips here.</p>
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
