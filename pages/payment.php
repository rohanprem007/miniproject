<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Payment - TravelEase</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="page-style.css">
    <!-- Stylesheet for the payment form -->
    <link rel="stylesheet" href="payment-style.css">
</head>
<body>

    <!-- Header -->
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
                <h1>Secure Payment</h1>
                <p>Complete your booking by providing your payment details below.</p>
            </div>
        </section>
        
        <section class="page-content">
            <div class="payment-container">
                <div class="payment-form">
                    <form action="#" method="POST" id="paymentForm"> <!-- Changed action to '#' -->
                        <h3 class="form-title">Payment Details</h3>
                        
                        <!-- Hidden fields for booking ID and amount -->
                        <input type="hidden" name="booking_id" value="B12345">
                        <input type="hidden" name="amount" value="25000.00">

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

                        <button type="submit" class="btn-pay">Pay ₹25,000.00</button>
                    </form>
                </div>
                <div class="order-summary">
                    <h3 class="summary-title">Order Summary</h3>
                    <div class="summary-item">
                        <span>Booking ID:</span>
                        <span>B12345</span>
                    </div>
                    <div class="summary-item">
                        <span>Package:</span>
                        <span>Golden Triangle Tour (Example)</span>
                    </div>
                    <div class="summary-item total">
                        <span>Total Amount:</span>
                        <span>₹25,000.00</span>
                    </div>
                    <div class="secure-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <span>Secure SSL Encryption</span>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 TravelEase. All Rights Reserved.</p> <!-- Replaced PHP date with static year -->
        </div>
    </footer>
     <script src="../webpage/script.js"></script>
</body>
</html>
