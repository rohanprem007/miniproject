<?php
session_start();
require_once '../connect/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = '';

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uname = $conn->real_escape_string($_POST['uname']);
    $phone = $conn->real_escape_string($_POST['phone']);
    
    $stmt = $conn->prepare("UPDATE users SET uname = ?, phone = ? WHERE user_id = ?");
    $stmt->bind_param("ssi", $uname, $phone, $user_id);
    if ($stmt->execute()) {
        $_SESSION['user_name'] = $uname; // Update session name
        $message = "Profile updated successfully!";
    } else {
        $message = "Error updating profile.";
    }
    $stmt->close();
}

// Fetch current user data
$stmt = $conn->prepare("SELECT uname, email, phone FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - TravelEase</title>
    <link rel="stylesheet" href="user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<div class="dashboard-layout">
    <?php include 'user_sidebar.php'; ?>
    <div class="main-container">
        <header class="main-header">
            <button class="mobile-menu-button" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>
            <h1 class="page-title">My Profile</h1>
        </header>
        <main>
            <div class="content-section" style="max-width: 600px;">
                <h3>Update Your Information</h3>
                <?php if ($message): ?>
                    <p style="color: #6ee7b7; background-color: rgba(16, 185, 129, 0.2); padding: 10px; border-radius: 8px;"><?php echo $message; ?></p>
                <?php endif; ?>
                <form action="my_profile.php" method="POST" class="profile-form">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
                        <small>Email address cannot be changed.</small>
                    </div>
                    <div class="form-group">
                        <label for="uname">Full Name</label>
                        <input type="text" id="uname" name="uname" value="<?php echo htmlspecialchars($user['uname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                    </div>
                    <button type="submit" class="submit-btn">Save Changes</button>
                </form>
            </div>
        </main>
    </div>
</div>
<style>
.profile-form .form-group { margin-bottom: 1.5rem; }
.profile-form label { font-weight: 600; }
.profile-form input { background-color: #1a202c; border: 1px solid #4a5568; color: #e2e8f0; padding: 12px; border-radius: 8px; width: 100%; box-sizing: border-box; }
.profile-form input:disabled { background-color: #2d3748; cursor: not-allowed; }
.profile-form small { color: #a0aec0; font-size: 0.8rem; margin-top: 5px; display: block; }
.submit-btn { background-color: #3b82f6; color: white; padding: 12px; border: none; border-radius: 8px; cursor: pointer; width: 100%; font-size: 1rem; font-weight: 600; }
</style>
<script src="user_script.js"></script>
</body>
</html>
