<?php
session_start();
require_once '../connect/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch CONFIRMED bookings that are ready for payment (i.e., not yet paid)
$confirmed_sql = "SELECT b.bid, p.package_name, p.price
                  FROM booking b
                  JOIN package p ON b.package_id = p.package_id
                  LEFT JOIN payment pay ON b.bid = pay.bid
                  WHERE b.user_id = ? AND b.status = 'Confirmed' AND pay.pid IS NULL
                  ORDER BY b.booking_date DESC";
$stmt_confirmed = $conn->prepare($confirmed_sql);
$stmt_confirmed->bind_param("i", $user_id);
$stmt_confirmed->execute();
$confirmed_result = $stmt_confirmed->get_result();

// Fetch completed payment history
$history_sql = "SELECT pay.pid, p.package_name, pay.amount, pay.payment_method, pay.payment_date, pay.status
                FROM payment pay
                JOIN booking b ON pay.bid = b.bid
                JOIN package p ON b.package_id = p.package_id
                WHERE b.user_id = ?
                ORDER BY pay.payment_date DESC";
$stmt_history = $conn->prepare($history_sql);
$stmt_history->bind_param("i", $user_id);
$stmt_history->execute();
$history_result = $stmt_history->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Payments - TravelEase</title>
    <link rel="stylesheet" href="user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<div class="dashboard-layout">
    <?php include 'user_sidebar.php'; ?>
    <div class="main-container">
        <header class="main-header">
            <button class="mobile-menu-button" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>
            <h1 class="page-title">My Payments</h1>
        </header>
        <main>
            <!-- Section for Confirmed Bookings Awaiting Payment -->
            <div class="content-section">
                <h3>Confirmed Bookings to Pay</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Package Name</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($confirmed_result && $confirmed_result->num_rows > 0): ?>
                                <?php while($row = $confirmed_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['bid']); ?></td>
                                        <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                                        <td>₹<?php echo number_format($row['price'], 2); ?></td>
                                        <td class="actions">
                                            <a href="payment_page.php?booking_id=<?php echo $row['bid']; ?>" class="action-btn pay" title="Pay Now"><i class="fas fa-credit-card"></i></a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">No confirmed bookings are awaiting payment.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section for Payment History -->
            <div class="content-section">
                <h3>Payment History</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>Package Name</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($history_result && $history_result->num_rows > 0): ?>
                                <?php while($row = $history_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['pid']); ?></td>
                                        <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                                        <td>₹<?php echo number_format($row['amount'], 2); ?></td>
                                        <td><?php echo htmlspecialchars($row['payment_method']); ?></td>
                                        <td><?php echo date("d M, Y h:i A", strtotime($row['payment_date'])); ?></td>
                                        <td><span class="status-pill <?php echo strtolower(htmlspecialchars($row['status'])); ?>"><?php echo htmlspecialchars($row['status']); ?></span></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">You have no payment history.</td>
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
