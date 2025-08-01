<?php
// --- PHP LOGIC BLOCK ---
include '../connect/db_connect.php';
$packages = [];
$sql = "SELECT package_name, description, price, duration, destination FROM package";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $packages = $result->fetch_all(MYSQLI_ASSOC);
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Packages - TravelEase</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="../webpage/style.css">
    <link rel="stylesheet" href="page-style.css">
</head>
<body>

    <!-- Header -->
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
                            <a href="../user/login page.php">User Login</a>
                            <a href="#">Admin Login</a>
                        </div>
                    </div>
                    <a href="#" class="signup-btn">Sign up</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="page-main">
        <!-- New Broad Features Section -->
        <section class="broad-features">
            <div class="container">
                <div class="section-header">
                    <h2>Why Choose TravelEase?</h2>
                    <p>We provide seamless and unforgettable travel experiences tailored just for you.</p>
                </div>
                <div class="broad-features-grid">
                    <!-- Card 1 -->
                    <div class="broad-card">
                        <div class="card-background" style="background-image: url('https://placehold.co/600x400/3f51b5/ffffff?text=Expert+Guides');"></div>
                        <div class="card-content">
                            <h3>Expert Local Guides</h3>
                            <p>Discover hidden gems with our knowledgeable and friendly local guides who bring each destination to life.</p>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="broad-card">
                        <div class="card-background" style="background-image: url('https://placehold.co/600x400/e91e63/ffffff?text=Custom+Trips');"></div>
                        <div class="card-content">
                            <h3>Tailor-Made Itineraries</h3>
                            <p>Your dream vacation, your way. We specialize in creating personalized trips that match your interests and budget.</p>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="broad-card">
                        <div class="card-background" style="background-image: url('https://placehold.co/600x400/4caf50/ffffff?text=24/7+Support');"></div>
                        <div class="card-content">
                            <h3>24/7 Support</h3>
                            <p>Travel with peace of mind knowing our dedicated support team is available around the clock to assist you.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="page-content" id="packages-grid">
            <div class="container">
                <h2 class="section-title">Our Top Packages</h2>
                <div class="package-grid">
                    <?php if (!empty($packages)): ?>
                        <?php foreach ($packages as $package): ?>
                            <div class="package-item">
                                <h3><?= htmlspecialchars($package["package_name"]) ?></h3>
                                <p class="destination"><?= htmlspecialchars($package["destination"]) ?></p>
                                <p><?= htmlspecialchars($package["description"]) ?></p>
                                <div class="package-details">
                                    <span class="price">₹<?= number_format($package["price"]) ?></span>
                                    <span class="duration"><?= htmlspecialchars($package["duration"]) ?></span>
                                </div>
                                <a href="#" class="btn-book">Book Now</a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No packages available at the moment. Please check back later.</p>
                    <?php endif; ?>
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
    <script src="../webpage/script.js"></script>
</body>
</html>
