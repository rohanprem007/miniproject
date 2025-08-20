<?php
session_start();
// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Feedback - TravelEase</title>
    <link rel="stylesheet" href="user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<div class="dashboard-layout">
    <?php include 'user_sidebar.php'; ?>
    <div class="main-container">
        <header class="main-header">
            <button class="mobile-menu-button" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>
            <h1 class="page-title">Share Your Feedback</h1>
        </header>
        <main>
            <div class="content-section" style="max-width: 700px;">
                <h3>We value your opinion</h3>
                <p class="text-secondary">Let us know what you think about your experience. Your feedback helps us improve our services.</p>
                <form id="feedbackForm" class="feedback-form">
                    <div class="form-group">
                        <label for="feedbackText">Your Feedback</label>
                        <textarea id="feedbackText" name="feedback_text" rows="8" placeholder="Tell us about your trip, our services, or any suggestions you have..." required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Submit Feedback</button>
                </form>
            </div>
        </main>
    </div>
</div>
<script src="user_script.js"></script>
</body>
</html>
