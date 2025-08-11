<?php
// user/user_logout.php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the main homepage after logout
header("Location: ../webpage/index.php");
exit();
?>
