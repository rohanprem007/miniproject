<?php
// admin_dashboard.php
session_start();
require_once 'db_connection.php';

// If the admin is not logged in, redirect to the login page.
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}

// --- Fetching Live Data from the Database for the Dashboard ---

// Total Bookings
$bookings_result = $conn->query("SELECT COUNT(*) as total FROM booking");
$total_bookings = $bookings_result->fetch_assoc()['total'] ?? 0;

// Total Users
$users_result = $conn->query("SELECT COUNT(*) as total FROM users");
$total_users = $users_result->fetch_assoc()['total'] ?? 0;

// Total Packages
$packages_result = $conn->query("SELECT COUNT(*) as total FROM package");
$total_packages = $packages_result->fetch_assoc()['total'] ?? 0;

// Total Payments (assuming a 'payment' table exists)
$payments_result = $conn->query("SELECT COUNT(*) as total FROM payment");
$total_payments = $payments_result->fetch_assoc()['total'] ?? 0;

// Total Feedback
$feedback_result = $conn->query("SELECT COUNT(*) as total FROM feedback");
$total_feedback = $feedback_result->fetch_assoc()['total'] ?? 0;

// Fetch recent bookings to display in a table
$recent_bookings_sql = "SELECT b.bid, u.uname, p.package_name, b.booking_date, b.status 
                        FROM booking b
                        JOIN users u ON b.user_id = u.user_id
                        JOIN package p ON b.package_id = p.package_id
                        ORDER BY b.booking_date DESC
                        LIMIT 5";
$recent_bookings_result = $conn->query($recent_bookings_sql);

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
    
    <?php include 'sidebar.php'; // The sidebar remains the same, providing navigation. ?>

    <!-- Main Content -->
    <div class="main-container">
        <header class="main-header">
            <!-- Mobile menu button -->
            <button class="mobile-menu-button" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>
            <h1 class="page-title">Dashboard Overview</h1>
        </header>

        <main>
            <!-- Stats Grid - Displays key metrics -->
            <div class="stats-grid">
                <a href="manage_bookings.php" class="stat-card-link">
                    <div class="stat-card bookings">
                        <div class="icon"><i class="fas fa-suitcase-rolling"></i></div>
                        <div class="info"><h3>Total Bookings</h3><p><?php echo $total_bookings; ?></p></div>
                    </div>
                </a>
                <a href="manage_users.php" class="stat-card-link">
                    <div class="stat-card users">
                        <div class="icon"><i class="fas fa-users"></i></div>
                        <div class="info"><h3>Total Users</h3><p><?php echo $total_users; ?></p></div>
                    </div>
                </a>
                <a href="manage_packages.php" class="stat-card-link">
                    <div class="stat-card packages">
                        <div class="icon"><i class="fas fa-box-open"></i></div>
                        <div class="info"><h3>Packages</h3><p><?php echo $total_packages; ?></p></div>
                    </div>
                </a>
                <a href="manage_payments.php" class="stat-card-link">
                    <div class="stat-card payments">
                        <div class="icon"><i class="fas fa-credit-card"></i></div>
                        <div class="info"><h3>Total Payments</h3><p><?php echo $total_payments; ?></p></div>
                    </div>
                </a>
                <a href="manage_feedback.php" class="stat-card-link">
                    <div class="stat-card feedback">
                        <div class="icon"><i class="fas fa-comment-dots"></i></div>
                        <div class="info"><h3>Feedback</h3><p><?php echo $total_feedback; ?></p></div>
                    </div>
                </a>
            </div>

            <!-- Recent Bookings Section -->
            <div class="content-section">
                <div class="content-header">
                    <h3>Recent Bookings</h3>
                    <a href="manage_bookings.php" class="view-all-btn">View All</a>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Customer</th>
                                <th>Package</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($recent_bookings_result && $recent_bookings_result->num_rows > 0): ?>
                                <?php while($row = $recent_bookings_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['bid']); ?></td>
                                        <td><?php echo htmlspecialchars($row['uname']); ?></td>
                                        <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                                        <td><?php echo date("d M, Y", strtotime($row['booking_date'])); ?></td>
                                        <td><span class="status-pill <?php echo strtolower(htmlspecialchars($row['status'])); ?>"><?php echo htmlspecialchars($row['status']); ?></span></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No recent bookings found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="admin_script.js"></script>
</body>
</html>
