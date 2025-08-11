<?php
session_start();
require_once '../connect/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch all bookings for the logged-in user
$sql = "SELECT b.bid, p.package_name, p.destination, b.booking_date, b.status 
        FROM booking b
        JOIN package p ON b.package_id = p.package_id
        WHERE b.user_id = $user_id
        ORDER BY b.booking_date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - TravelEase</title>
    <link rel="stylesheet" href="user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<div class="dashboard-layout">
    <?php include 'user_sidebar.php'; ?>
    <div class="main-container">
        <header class="main-header">
            <button class="mobile-menu-button" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>
            <h1 class="page-title">My Bookings</h1>
        </header>
        <main>
            <div class="content-section">
                <h3>Your Travel History</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Package Name</th>
                                <th>Destination</th>
                                <th>Booking Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="bookingsTableBody">
                            <?php if ($result && $result->num_rows > 0): ?>
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr data-id="<?php echo $row['bid']; ?>">
                                        <td><?php echo htmlspecialchars($row['bid']); ?></td>
                                        <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['destination']); ?></td>
                                        <td><?php echo date("d M, Y", strtotime($row['booking_date'])); ?></td>
                                        <td><span class="status-pill <?php echo strtolower(htmlspecialchars($row['status'])); ?>"><?php echo htmlspecialchars($row['status']); ?></span></td>
                                        <td class="actions">
                                            <button class="action-btn delete delete-booking-btn" title="Delete Booking"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">You haven't booked any packages yet.</td>
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
