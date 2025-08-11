<?php
// admin_logout.php
// This script handles the admin logout process.

// Always start the session to access session variables.
session_start();

// Unset all of the session variables.
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to the login page after logging out.
header("Location: admin_login.php");
exit();
?>
