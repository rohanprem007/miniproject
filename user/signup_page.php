<?php
// user/signup_page.php
session_start();
require_once '../connect/db_connect.php';

$error_message = '';

// If the user is already logged in, redirect them to their dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: user_dashboard.php");
    exit();
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $conn->real_escape_string($_POST['uname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; 
    $phone = $conn->real_escape_string($_POST['phone']);

    // Validation
    if (empty($uname) || empty($email) || empty($password) || empty($phone)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } else {
        // Check if email already exists
        $stmt_check = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            $error_message = "An account with this email already exists.";
        } else {
            // Insert new user into the database
            $stmt_insert = $conn->prepare("INSERT INTO users (uname, email, password, phone) VALUES (?, ?, ?, ?)");
            $stmt_insert->bind_param("ssss", $uname, $email, $password, $phone);

            if ($stmt_insert->execute()) {
                // --- Registration Successful ---
                // Redirect to the login page with a success message indicator
                header("Location: login_page.php?registration=success");
                exit();
            } else {
                $error_message = "Registration failed. Please try again.";
            }
            $stmt_insert->close();
        }
        $stmt_check->close();
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - TravelEase</title>
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
                <p>Create an account to start your journey.</p>
                <form action="signup_page.php" method="POST" class="login-form">
                    <?php if (!empty($error_message)): ?>
                        <p class="error-message" style="color: #fca5a5; background-color: rgba(239, 68, 68, 0.2); padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center;"><?php echo htmlspecialchars($error_message); ?></p>
                    <?php endif; ?>
                    <div class="input-group">
                        <i class="fas fa-user icon"></i>
                        <input type="text" name="uname" placeholder="Full Name" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-envelope icon"></i>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock icon"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-phone icon"></i>
                        <input type="tel" name="phone" placeholder="Phone Number" required>
                    </div>
                    <button type="submit" class="btn-login">Sign Up</button>
                    <div class="signup-link">
                        <p>Already have an account? <a href="login_page.php">Sign In</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
