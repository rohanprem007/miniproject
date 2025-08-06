<?php
// admin_dashboard.php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}

// --- Fetching Live Data from the Database ---
$bookings_result = $conn->query("SELECT COUNT(*) as total FROM booking");
$total_bookings = ($bookings_result->num_rows > 0) ? $bookings_result->fetch_assoc()['total'] : 0;

$users_result = $conn->query("SELECT COUNT(*) as total FROM users");
$total_users = ($users_result->num_rows > 0) ? $users_result->fetch_assoc()['total'] : 0;

$packages_result = $conn->query("SELECT COUNT(*) as total FROM package");
$total_packages = ($packages_result->num_rows > 0) ? $packages_result->fetch_assoc()['total'] : 0;

$payments_result = $conn->query("SELECT COUNT(*) as total FROM payment");
$total_payments = ($payments_result->num_rows > 0) ? $payments_result->fetch_assoc()['total'] : 0;

$feedback_result = $conn->query("SELECT COUNT(*) as total FROM feedback");
$total_feedback = ($feedback_result->num_rows > 0) ? $feedback_result->fetch_assoc()['total'] : 0;

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Travelease</title>
    <link rel="stylesheet" href="admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<div class="dashboard-layout">
    
    <?php include 'sidebar.php'; // This includes the updated sidebar file ?>

    <!-- Main Content -->
    <div class="main-container">
        <header class="main-header">
            <button class="mobile-menu-button" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>
            <h1 class="page-title">Dashboard Overview</h1>
        </header>

        <main>
            <!-- Stats Grid - Now showing live data including payments -->
            <div class="stats-grid">
                <div class="stat-card bookings">
                    <div class="icon"><i class="fas fa-suitcase-rolling"></i></div>
                    <div class="info"><h3>Total Bookings</h3><p><?php echo $total_bookings; ?></p></div>
                </div>
                <div class="stat-card users">
                    <div class="icon"><i class="fas fa-users"></i></div>
                    <div class="info"><h3>Total Users</h3><p><?php echo $total_users; ?></p></div>
                </div>
                <div class="stat-card packages">
                    <div class="icon"><i class="fas fa-box-open"></i></div>
                    <div class="info"><h3>Packages</h3><p><?php echo $total_packages; ?></p></div>
                </div>
                <div class="stat-card payments">
                    <div class="icon"><i class="fas fa-credit-card"></i></div>
                    <div class="info"><h3>Total Payments</h3><p><?php echo $total_payments; ?></p></div>
                </div>
                <div class="stat-card feedback">
                    <div class="icon"><i class="fas fa-comment-dots"></i></div>
                    <div class="info"><h3>Feedback</h3><p><?php echo $total_feedback; ?></p></div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="content-section">
                <h3>Welcome to Your Dashboard</h3>
                <p>You are viewing live data from your website's database. Use the sidebar to navigate and manage different aspects of your tourism platform.</p>
            </div>
        </main>
    </div>
</div>

<script src="admin_script.js"></script>
</body>
</html>
