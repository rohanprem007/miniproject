<?php
// sidebar.php
// This file contains the sidebar navigation for the admin panel.
// It helps to avoid code repetition across pages.

// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);
$admin_email = $_SESSION['admin_email'] ?? 'Admin';
$avatar_initial = strtoupper(substr($admin_email, 0, 1));
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <a href="admin_dashboard.php" class="logo">Travelease</a>
    </div>
    <ul class="sidebar-nav">
        <li><a href="admin_dashboard.php" class="<?php echo ($current_page == 'admin_dashboard.php') ? 'active' : ''; ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="manage_bookings.php" class="<?php echo ($current_page == 'manage_bookings.php') ? 'active' : ''; ?>"><i class="fas fa-suitcase-rolling"></i> Bookings</a></li>
        <li><a href="manage_users.php" class="<?php echo ($current_page == 'manage_users.php') ? 'active' : ''; ?>"><i class="fas fa-users"></i> Users</a></li>
        <li><a href="manage_packages.php" class="<?php echo ($current_page == 'manage_packages.php') ? 'active' : ''; ?>"><i class="fas fa-box-open"></i> Packages</a></li>
        <li><a href="manage_payments.php" class="<?php echo ($current_page == 'manage_payments.php') ? 'active' : ''; ?>"><i class="fas fa-credit-card"></i> Payments</a></li>
        <li><a href="manage_feedback.php" class="<?php echo ($current_page == 'manage_feedback.php') ? 'active' : ''; ?>"><i class="fas fa-comment-dots"></i> Feedback</a></li>
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
