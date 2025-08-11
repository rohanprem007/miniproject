<?php
session_start();
require_once '../connect/db_connect.php';

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.php");
    exit();
}

// Fetch all available packages from the database
$sql = "SELECT package_id, package_name, description, price, duration, destination FROM package ORDER BY package_name ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Packages - TravelEase</title>
    <link rel="stylesheet" href="user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<div class="dashboard-layout">
    <?php include 'user_sidebar.php'; ?>
    <div class="main-container">
        <header class="main-header">
            <button class="mobile-menu-button" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>
            <h1 class="page-title">Explore Our Packages</h1>
        </header>
        <main>
            <div class="content-section">
                <div class="package-grid" id="packageGrid">
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while($package = $result->fetch_assoc()): ?>
                            <div class="package-item">
                                <h3><?php echo htmlspecialchars($package["package_name"]); ?></h3>
                                <p class="destination"><?php echo htmlspecialchars($package["destination"]); ?></p>
                                <p><?php echo htmlspecialchars($package["description"]); ?></p>
                                <div class="package-details">
                                    <span class="price">₹<?php echo number_format($package["price"]); ?></span>
                                    <span class="duration"><?php echo htmlspecialchars($package["duration"]); ?></span>
                                </div>
                                <!-- Added class and data attribute to the button -->
                                <button class="btn-book book-now-btn" data-package-id="<?php echo $package['package_id']; ?>">Book Now</button>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No packages are available at the moment. Please check back later.</p>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="user_script.js"></script>
</body>
</html>
