<?php
session_start();
require_once '../connect/db_connect.php';

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.php");
    exit();
}

// Check if a booking ID is provided in the URL
if (!isset($_GET['booking_id'])) {
    header("Location: my_payments.php"); // Redirect if no booking ID
    exit();
}

$user_id = $_SESSION['user_id'];
$booking_id = (int)$_GET['booking_id'];

// Fetch booking details to ensure it belongs to the user and is CONFIRMED
$sql = "SELECT b.bid, p.package_name, p.price 
        FROM booking b
        JOIN package p ON b.package_id = p.package_id
        WHERE b.bid = ? AND b.user_id = ? AND b.status = 'Confirmed'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $booking_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    // Redirect if the booking is not found, doesn't belong to the user, or is not confirmed
    header("Location: my_payments.php");
    exit();
}
$booking = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Payment - TravelEase</title>
    <link rel="stylesheet" href="user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<div class="dashboard-layout">
    <?php include 'user_sidebar.php'; ?>
    <div class="main-container">
        <header class="main-header">
            <button class="mobile-menu-button" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>
            <h1 class="page-title">Secure Payment</h1>
        </header>
        <main>
            <div class="payment-container">
                <div class="payment-form">
                    <form id="paymentForm">
                        <h3 class="form-title">Payment Details</h3>
                        
                        <input type="hidden" name="booking_id" value="<?php echo $booking['bid']; ?>">
                        <input type="hidden" name="amount" value="<?php echo $booking['price']; ?>">

                        <div class="input-group">
                            <label for="cardholder-name">Cardholder Name</label>
                            <input type="text" id="cardholder-name" name="cardholder_name" placeholder="John M. Doe" required>
                        </div>

                        <div class="input-group">
                            <label for="card-number">Card Number</label>
                            <input type="text" id="card-number" name="card_number" placeholder="1111-2222-3333-4444" required>
                        </div>

                        <div class="row">
                            <div class="input-group">
                                <label for="expiry-date">Expiry Date</label>
                                <input type="text" id="expiry-date" name="expiry_date" placeholder="MM / YY" required>
                            </div>
                            <div class="input-group">
                                <label for="cvc">CVC</label>
                                <input type="text" id="cvc" name="cvc" placeholder="123" required>
                            </div>
                        </div>

                        <button type="submit" class="btn-pay">Pay ₹<?php echo number_format($booking['price'], 2); ?></button>
                    </form>
                </div>
                <div class="order-summary">
                    <h3 class="summary-title">Order Summary</h3>
                    <div class="summary-item">
                        <span>Booking ID:</span>
                        <span><?php echo htmlspecialchars($booking['bid']); ?></span>
                    </div>
                    <div class="summary-item">
                        <span>Package:</span>
                        <span><?php echo htmlspecialchars($booking['package_name']); ?></span>
                    </div>
                    <div class="summary-item total">
                        <span>Total Amount:</span>
                        <span>₹<?php echo number_format($booking['price'], 2); ?></span>
                    </div>
                    <div class="secure-badge">
                        <i class="fas fa-lock"></i>
                        <span>Secure SSL Encryption</span>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="user_script.js"></script>
</body>
</html>
