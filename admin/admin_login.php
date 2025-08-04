<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - TravelEase</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Login Page Stylesheet -->
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>

    <div class="login-background">
        <div class="login-container">
            <div class="login-form-wrapper">
                <div class="logo-header">
                    <a href="../webpage/index.php">TravelEase</a>
                </div>
                <!--<h2>Sign in to your Account</h2>-->
                <p>Welcome back Admin! Please enter your details.</p>
                <form action="#" method="POST" class="login-form">
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
                        <p>Don't have an account? <a href="#">Sign Up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Login Page JavaScript -->
    <script src="login_script.js"></script>

</body>
</html>
