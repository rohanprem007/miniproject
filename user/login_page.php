<?php
session_start();
require_once '../connect/db_connect.php'; 

$error_message = '';
$success_message = '';

// Check for a successful registration message
if (isset($_GET['registration']) && $_GET['registration'] === 'success') {
    $success_message = "Registration successful! Please sign in to continue.";
}

if (isset($_SESSION['user_id'])) {
    header("Location: user_dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT user_id, uname, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['uname'];
            $_SESSION['user_email'] = $user['email'];
            header("Location: user_dashboard.php");
            exit();
        } else {
            $error_message = "Invalid email or password.";
        }
    } else {
        $error_message = "Invalid email or password.";
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - TravelEase</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="login_style.css">
</head>
<body>
    <div class="login-background">
        <div class="login-container">
            <div class="login-form-wrapper">
                <div class="logo-header">
                    <a href="../webpage/index.php" class="font-script">TravelEase</a>
                </div>
                <p>Welcome back! Please enter your details.</p>
                <form action="login_page.php" method="POST" class="login-form">
                    <?php if (!empty($error_message)): ?>
                        <p class="error-message" style="color: #fca5a5; background-color: rgba(239, 68, 68, 0.2); padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center;"><?php echo htmlspecialchars($error_message); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($success_message)): ?>
                        <p class="success-message" style="color: #6ee7b7; background-color: rgba(16, 185, 129, 0.2); padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center;"><?php echo htmlspecialchars($success_message); ?></p>
                    <?php endif; ?>
                    <div class="input-group">
                        <i class="fas fa-envelope icon"></i>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock icon"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="options">
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn-login">Sign In</button>
                    <div class="signup-link">
                        <p>Don't have an account? <a href="signup_page.php">Sign Up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="login_script.js"></script>
</body>
</html>
