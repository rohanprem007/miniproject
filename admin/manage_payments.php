<?php
session_start();
require_once 'db_connection.php';

// Security: Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all payments with booking and user details
$sql = "SELECT 
            pay.pid, 
            pay.payment_method, 
            pay.amount, 
            pay.payment_date, 
            pay.status, 
            b.bid, 
            u.uname
        FROM payment pay
        JOIN booking b ON pay.bid = b.bid
        JOIN users u ON b.user_id = u.user_id
        ORDER BY pay.payment_date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Payments - Admin</title>
    <link rel="stylesheet" href="admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<div class="dashboard-layout">
    <?php include 'sidebar.php'; // Use the centralized sidebar ?>
    <div class="main-container">
        <header class="main-header">
            <button class="mobile-menu-button" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>
            <h1 class="page-title">Manage Payments</h1>
        </header>
        <main>
            <div class="content-section">
                <h3>All Transaction Records</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>Booking ID</th>
                                <th>Customer Name</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Payment Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && $result->num_rows > 0): ?>
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['pid']); ?></td>
                                        <td><?php echo htmlspecialchars($row['bid']); ?></td>
                                        <td><?php echo htmlspecialchars($row['uname']); ?></td>
                                        <td>₹<?php echo number_format($row['amount'], 2); ?></td>
                                        <td><?php echo htmlspecialchars($row['payment_method']); ?></td>
                                        <td><?php echo date("d M, Y h:i A", strtotime($row['payment_date'])); ?></td>
                                        <td><span class="status-pill <?php echo strtolower(htmlspecialchars($row['status'])); ?>"><?php echo htmlspecialchars($row['status']); ?></span></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No payment records found.</td>
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
