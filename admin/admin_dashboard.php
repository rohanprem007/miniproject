<?php
// admin_dashboard.php
session_start();

// Security Check: Redirect if not logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}

$admin_email = $_SESSION['admin_email'];
// Create a simple initial for the avatar from the email
$avatar_initial = strtoupper(substr($admin_email, 0, 1));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Travelease</title>
    
    <!-- Link to the new external stylesheet -->
    <link rel="stylesheet" href="admin_style.css">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>

<div class="dashboard-layout">
    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="admin_dashboard.php" class="logo">Travelease</a>
        </div>
        <ul class="sidebar-nav">
            <li><a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-suitcase-rolling"></i> Bookings</a></li>
            <li><a href="#"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="#"><i class="fas fa-box-open"></i> Packages</a></li>
            <li><a href="#"><i class="fas fa-comment-dots"></i> Feedback</a></li>
        </ul>
        <div class="sidebar-footer">
             <div class="user-profile">
                <div class="avatar"><?php echo htmlspecialchars($avatar_initial); ?></div>
                <div class="user-info">
                    <span><?php echo htmlspecialchars($admin_email); ?></span>
                    <a href="admin_logout.php">Logout</a>
                </div>
             </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Main Header -->
        <header class="main-header">
            <button class="mobile-menu-button" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
            <h1 class="page-title">Dashboard Overview</h1>
        </header>

        <main>
            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card bookings">
                    <div class="icon"><i class="fas fa-suitcase-rolling"></i></div>
                    <div class="info">
                        <h3>Total Bookings</h3>
                        <p>125</p>
                    </div>
                </div>
                <div class="stat-card users">
                    <div class="icon"><i class="fas fa-users"></i></div>
                    <div class="info">
                        <h3>Total Users</h3>
                        <p>42</p>
                    </div>
                </div>
                <div class="stat-card packages">
                    <div class="icon"><i class="fas fa-box-open"></i></div>
                    <div class="info">
                        <h3>Packages</h3>
                        <p>15</p>
                    </div>
                </div>
                <div class="stat-card feedback">
                    <div class="icon"><i class="fas fa-comment-dots"></i></div>
                    <div class="info">
                        <h3>Feedback</h3>
                        <p>8</p>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="content-section">
                <h3>Manage Your Site</h3>
                <p>Select an option from the sidebar to manage bookings, view user information, add or edit packages, and review customer feedback. The data here is currently static and can be connected to your database.</p>
            </div>
        </main>
    </div>
</div>

<script>
    // Simple JavaScript to toggle the sidebar on mobile
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebar = document.querySelector('.sidebar');

    mobileMenuBtn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
</script>

</body>
</html>
