<?php include '../connect/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Packages - TravelEase</title>
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

    <!-- Main Content -->
    <main class="page-main">
        <section class="page-header">
            <div class="container">
                <h1>Explore Our Tour Packages</h1>
                <p>Find the perfect getaway from our curated list of destinations.</p>
            </div>
        </section>

        <section class="page-content">
            <div class="container">
                <div class="package-grid">
                    <?php
                    $sql = "SELECT package_name, description, price, duration, destination FROM package";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="package-item">';
                            echo '<h3>' . htmlspecialchars($row["package_name"]) . '</h3>';
                            echo '<p class="destination">' . htmlspecialchars($row["destination"]) . '</p>';
                            echo '<p>' . htmlspecialchars($row["description"]) . '</p>';
                            echo '<div class="package-details">';
                            echo '<span class="price">₹' . number_format($row["price"]) . '</span>';
                            echo '<span class="duration">' . htmlspecialchars($row["duration"]) . '</span>';
                            echo '</div>';
                            echo '<a href="#" class="btn-book">Book Now</a>';
                            echo '</div>';
                        }
                    } else {
                        echo "<p>No packages available at the moment.</p>";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> TravelEase. All Rights Reserved.</p>
        </div>
     <script src="../webpage/script.js"></script>
</body>
</html>
