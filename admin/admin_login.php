<?php
// admin/admin_login.php
session_start();
require_once 'db_connection.php';

$error_message = '';

// If the admin is already logged in, redirect them to the dashboard
if (isset($_SESSION['admin_email'])) {
    header("Location: admin_dashboard.php");
    exit();
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        if ($password === $admin['password']) {
            $_SESSION['admin_email'] = $admin['email'];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error_message = "Invalid email or password.";
        }
    } else {
        $error_message = "Invalid email or password.";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - TravelEase</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Linking to the user login stylesheet for a consistent look -->
    <link rel="stylesheet" href="../user/login_style.css">
</head>
<body>

    <div class="login-background">
        <div class="login-container">
            <div class="login-form-wrapper">
                <div class="logo-header">
                    <a href="../webpage/index.php" class="font-script">TravelEase</a>
                </div>
                <!-- Updated text for admin context -->
                <p>Welcome, Admin! Please enter your details.</p>
                <form action="admin_login.php" method="POST" class="login-form">
                    <?php if (!empty($error_message)): ?>
                        <p class="error-message" style="color: #fca5a5; background-color: rgba(239, 68, 68, 0.2); padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center;"><?php echo htmlspecialchars($error_message); ?></p>
                    <?php endif; ?>
                    <div class="input-group">
                        <i class="fas fa-envelope icon"></i>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock icon"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn-login">Sign In</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
