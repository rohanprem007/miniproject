<?php
session_start();
require_once '../connect/db_connect.php';

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user's total bookings
$bookings_result = $conn->query("SELECT COUNT(*) as total FROM booking WHERE user_id = $user_id");
$total_bookings = $bookings_result->fetch_assoc()['total'] ?? 0;

// Fetch user's confirmed bookings
$confirmed_result = $conn->query("SELECT COUNT(*) as total FROM booking WHERE user_id = $user_id AND status = 'Confirmed'");
$confirmed_bookings = $confirmed_result->fetch_assoc()['total'] ?? 0;

// Fetch user's pending bookings
$pending_result = $conn->query("SELECT COUNT(*) as total FROM booking WHERE user_id = $user_id AND status = 'Pending'");
$pending_bookings = $pending_result->fetch_assoc()['total'] ?? 0;

// Fetch recent bookings for the dashboard table
$recent_bookings_sql = "SELECT b.bid, p.package_name, b.booking_date, b.status 
                        FROM booking b
                        JOIN package p ON b.package_id = p.package_id
                        WHERE b.user_id = $user_id
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
    <title>My Dashboard - TravelEase</title>
    <link rel="stylesheet" href="user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<div class="dashboard-layout">
    
    <?php include 'user_sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-container">
        <header class="main-header">
            <button class="mobile-menu-button" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>
            <h1 class="page-title">Dashboard</h1>
        </header>

        <main>
            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card bookings">
                    <div class="icon"><i class="fas fa-suitcase-rolling"></i></div>
                    <div class="info"><h3>Total Bookings</h3><p><?php echo $total_bookings; ?></p></div>
                </div>
                <div class="stat-card confirmed">
                    <div class="icon"><i class="fas fa-check-circle"></i></div>
                    <div class="info"><h3>Confirmed</h3><p><?php echo $confirmed_bookings; ?></p></div>
                </div>
                <div class="stat-card pending">
                    <div class="icon"><i class="fas fa-clock"></i></div>
                    <div class="info"><h3>Pending</h3><p><?php echo $pending_bookings; ?></p></div>
                </div>
            </div>

            <!-- Recent Bookings Section -->
            <div class="content-section">
                <div class="content-header">
                    <h3>My Recent Bookings</h3>
                    <a href="my_bookings.php" class="view-all-btn">View All</a>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Package Name</th>
                                <th>Booking Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($recent_bookings_result && $recent_bookings_result->num_rows > 0): ?>
                                <?php while($row = $recent_bookings_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['bid']); ?></td>
                                        <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                                        <td><?php echo date("d M, Y", strtotime($row['booking_date'])); ?></td>
                                        <td><span class="status-pill <?php echo strtolower(htmlspecialchars($row['status'])); ?>"><?php echo htmlspecialchars($row['status']); ?></span></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">You have no recent bookings.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="user_script.js"></script>
</body>
</html>
