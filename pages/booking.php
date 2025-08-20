<?php
session_start();
require_once '../connect/db_connect.php';

// Fetch all packages to populate the dropdown
$packages = [];
$sql = "SELECT package_id, package_name, price FROM package ORDER BY package_name ASC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $packages[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Trip - TravelEase</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../webpage/style.css">
    <link rel="stylesheet" href="page-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
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
                <h1>Book Your Adventure</h1>
                <p>Select your desired package and let us handle the rest.</p>
            </div>
        </section>
        
        <section class="page-content">
            <div class="booking-container">
                <form class="booking-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="package-select">Choose Your Package</label>
                            <select id="package-select" name="package_id" required>
                                <option value="" disabled selected>Select a destination</option>
                                <?php foreach ($packages as $package): ?>
                                    <option value="<?php echo $package['package_id']; ?>">
                                        <?php echo htmlspecialchars($package['package_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="travel-date">Preferred Travel Date</label>
                            <input type="date" id="travel-date" name="travel_date" required>
                        </div>
                        <div class="form-group">
                            <label for="travelers">Number of Travelers</label>
                            <input type="number" id="travelers" name="travelers" min="1" value="1" required>
                        </div>
                    </div>
                    
                    <div class="login-prompt">
                        <div class="prompt-icon"><i class="fas fa-lock"></i></div>
                        <h3>Please Sign In to Continue</h3>
                        <p>To complete your booking and manage your trips, you need an account.</p>
                        <div class="prompt-actions">
                            <a href="../user/login_page.php" class="btn-prompt-login">Sign In</a>
                            <a href="../user/signup_page.php" class="btn-prompt-signup">Create Account</a>
                        </div>
                    </div>
                </form>
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
