<?php
// admin_login.php
session_start();
require_once 'db_connection.php';

$error_message = '';

// Redirect if already logged in
if (isset($_SESSION['admin_email'])) {
    header("Location: admin_dashboard.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        // IMPORTANT: In a real-world application, use password_verify()
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
    <!-- Updated Google Font to Dancing Script -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Updated font-family to Dancing Script */
        .font-script { font-family: 'Dancing Script', cursive; }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-gray-800 border border-gray-700 rounded-xl shadow-2xl p-8 m-4">
        
        <!-- Logo Section -->
        <div class="text-center mb-6">
            <a href="../webpage/index.php" class="inline-block">
                <!-- Updated class to use the new script font -->
                <h1 class="text-6xl font-script text-blue-500">
                   Travelease
                </h1>
            </a>
        </div>

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-100">Admin Panel Login</h2>
            <p class="text-gray-400">Please sign in to continue</p>
        </div>

        <!-- Login Form -->
        <form action="admin_login.php" method="POST" novalidate>
            <!-- Email Input -->
            <div class="mb-5">
                <label for="email" class="block text-gray-300 text-sm font-bold mb-2">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5">
                        <i class="fas fa-envelope text-gray-500"></i>
                    </span>
                    <input type="email" id="email" name="email" class="bg-gray-700 border border-gray-600 text-gray-100 placeholder-gray-500 shadow-sm appearance-none rounded-lg w-full py-3 pl-10 pr-4 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" placeholder="admin@travel.com" required>
                </div>
            </div>

            <!-- Password Input -->
            <div class="mb-6">
                <label for="password" class="block text-gray-300 text-sm font-bold mb-2">Password</label>
                 <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5">
                        <i class="fas fa-lock text-gray-500"></i>
                    </span>
                    <input type="password" id="password" name="password" class="bg-gray-700 border border-gray-600 text-gray-100 placeholder-gray-500 shadow-sm appearance-none rounded-lg w-full py-3 pl-10 pr-4 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" placeholder="************" required>
                </div>
            </div>

            <!-- Error Message Display -->
            <?php if (!empty($error_message)): ?>
                <div class="bg-red-900 bg-opacity-50 border border-red-700 text-red-300 p-4 rounded-lg mb-6" role="alert">
                    <p class="font-bold">Login Failed</p>
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
