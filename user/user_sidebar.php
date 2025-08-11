<?php
// user/user_sidebar.php
$current_page = basename($_SERVER['PHP_SELF']);
$user_name = $_SESSION['user_name'] ?? 'User';
$avatar_initial = strtoupper(substr($user_name, 0, 1));
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <a href="../webpage/index.php" class="logo font-script">Travelease</a>
    </div>
    <ul class="sidebar-nav">
        <li><a href="user_dashboard.php" class="<?php echo ($current_page == 'user_dashboard.php') ? 'active' : ''; ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="user_packages.php" class="<?php echo ($current_page == 'user_packages.php') ? 'active' : ''; ?>"><i class="fas fa-box-open"></i> Packages</a></li>
        <li><a href="my_bookings.php" class="<?php echo ($current_page == 'my_bookings.php') ? 'active' : ''; ?>"><i class="fas fa-suitcase-rolling"></i> My Bookings</a></li>
        <li><a href="my_payments.php" class="<?php echo ($current_page == 'my_payments.php') ? 'active' : ''; ?>"><i class="fas fa-credit-card"></i> My Payments</a></li>
        <li><a href="my_profile.php" class="<?php echo ($current_page == 'my_profile.php') ? 'active' : ''; ?>"><i class="fas fa-user"></i> My Profile</a></li>
    </ul>
    <div class="sidebar-footer">
         <div class="user-profile">
            <div class="avatar"><?php echo htmlspecialchars($avatar_initial); ?></div>
            <div class="user-info">
                <span><?php echo htmlspecialchars($user_name); ?></span>
                <a href="user_logout.php">Logout</a>
            </div>
         </div>
    </div>
</aside>

<!-- Toast Notification Container -->
<div id="toastContainer"></div>

<!-- Custom Confirmation Modal -->
<div id="confirmModal" class="custom-modal-overlay">
    <div class="custom-modal">
        <h3 id="confirmTitle">Confirm Action</h3>
        <p id="confirmMessage">Are you sure?</p>
        <div class="custom-modal-actions">
            <button id="confirmBtn" class="btn-confirm">Confirm</button>
            <button id="cancelBtn" class="btn-cancel">Cancel</button>
        </div>
    </div>
</div>
