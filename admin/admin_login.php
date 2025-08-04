<?php
// admin_login.php
// This is the login page for the administrator.

// Always start the session at the beginning of the script.
session_start();

// Include the database connection file.
require_once 'db_connection.php';

// Initialize an error message variable.
$error_message = '';

// --- Check if the user is already logged in ---
// If the admin is already logged in, redirect them to the dashboard.
if (isset($_SESSION['admin_email'])) {
    header("Location: admin_dashboard.php");
    exit();
}

// --- Handle Form Submission ---
// Check if the request method is POST, which means the form has been submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get email and password from the form, and sanitize them.
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; // We get the plain password first.

    // --- Query the database for the admin ---
    $sql = "SELECT * FROM admin WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $admin = $result->fetch_assoc();

        // --- Password Verification ---
        // !! SECURITY WARNING !!
        // Your current database stores passwords in plain text.
        // The code below checks the plain text password.
        // THIS IS NOT SECURE. You should use password_hash() and password_verify().

        if ($password === $admin['password']) {
            // --- Login Successful ---
            $_SESSION['admin_email'] = $admin['email'];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            // --- Login Failed (Incorrect Password) ---
            $error_message = "Invalid email or password.";
        }
    } else {
        // --- Login Failed (Email not found) ---
        $error_message = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Travelease</title>
    
    <!-- Using Tailwind CSS for modern styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts for a nicer look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Pacifico&display=swap" rel="stylesheet">
    <style>
        /* Using a custom font for the logo */
        .font-pacifico {
            font-family: 'Pacifico', cursive;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-xl shadow-2xl p-8 m-4">
        
        <!-- Logo Section -->
        <div class="text-center mb-6">
            <!-- This anchor tag makes the logo clickable and redirects to index.php -->
            <a href="index.php" class="inline-block">
                 <!-- You can replace this text-based logo with your own <img /> tag if you have a logo file -->
                <h1 class="text-5xl font-pacifico text-blue-600">
                   <a href="../webpage/index.php"> Travelease</a>
                </h1>
            </a>
        </div>

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Admin Panel Login</h2>
            <p class="text-gray-500">Please sign in to continue</p>
        </div>

        <!-- Login Form -->
        <form action="admin_login.php" method="POST" novalidate>
            <!-- Email Input -->
            <div class="mb-5">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </span>
                    <input type="email" id="email" name="email" class="shadow-sm appearance-none border rounded-lg w-full py-3 pl-10 pr-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" placeholder="admin@travel.com" required>
                </div>
            </div>

            <!-- Password Input -->
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                 <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5">
                        <i class="fas fa-lock text-gray-400"></i>
                    </span>
                    <input type="password" id="password" name="password" class="shadow-sm appearance-none border rounded-lg w-full py-3 pl-10 pr-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" placeholder="************" required>
                </div>
            </div>

            <!-- Error Message Display -->
            <?php if (!empty($error_message)): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6" role="alert">
                    <p class="font-bold">Error</p>
                    <p><?php echo htmlspecialchars($error_message); ?></p>
                </div>
            <?php endif; ?>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition-transform transform hover:scale-105 duration-300">
                    Sign In
                </button>
            </div>
        </form>
    </div>

</body>
</html>