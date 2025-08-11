<?php
session_start();
require_once 'db_connection.php';

// Security: Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all bookings with user and package details
$sql = "SELECT b.bid, b.booking_date, b.status, u.uname, p.package_name 
        FROM booking b
        JOIN users u ON b.user_id = u.user_id
        JOIN package p ON b.package_id = p.package_id
        ORDER BY b.booking_date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings - Admin</title>
    <link rel="stylesheet" href="admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<div class="dashboard-layout">
    <?php include 'sidebar.php'; ?>
    <div class="main-container">
        <header class="main-header">
            <button class="mobile-menu-button" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>
            <h1 class="page-title">Manage Bookings</h1>
        </header>
        <main>
            <div class="content-section">
                <h3>All Customer Bookings</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Customer Name</th>
                                <th>Package Name</th>
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
                                        <td><?php echo htmlspecialchars($row['uname']); ?></td>
                                        <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                                        <td><?php echo date("d M, Y", strtotime($row['booking_date'])); ?></td>
                                        <td><span class="status-pill <?php echo strtolower(htmlspecialchars($row['status'])); ?>"><?php echo htmlspecialchars($row['status']); ?></span></td>
                                        <td class="actions">
                                            <button class="action-btn edit edit-booking-btn" title="Edit Status"><i class="fas fa-pencil-alt"></i></button>
                                            <button class="action-btn delete delete-booking-btn" title="Delete Booking"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">No bookings found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal for Editing Booking Status -->
<div id="bookingModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2 id="bookingModalTitle">Edit Booking Status</h2>
        <form id="bookingForm">
            <input type="hidden" id="bookingId" name="booking_id">
            <div class="form-group">
                <p><strong>Booking ID:</strong> <span id="modalBookingId"></span></p>
                <p><strong>Customer:</strong> <span id="modalCustomerName"></span></p>
                <p><strong>Package:</strong> <span id="modalPackageName"></span></p>
            </div>
            <div class="form-group">
                <label for="bookingStatus">Booking Status</label>
                <select id="bookingStatus" name="status" required>
                    <option value="Pending">Pending</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
            <button type="submit" class="submit-btn" id="saveBookingBtn">Update Status</button>
        </form>
    </div>
</div>

<script src="admin_script.js"></script>
</body>
</html>
