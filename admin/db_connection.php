<?php
// db_connection.php
// This file centralizes the database connection logic.

// --- Database Credentials ---
// Replace with your actual database server details.
$servername = "127.0.0.1:3306"; // Or "localhost"
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "tourism_db";

// --- Create Connection ---
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (Exception $e) {
    // If connection fails, stop the script and display an error.
    // In a production environment, you might want to log this error instead of showing it to the user.
    die("Connection failed: " . $e->getMessage());
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Note: We don't close the connection here.
// It will be included in other files and will be closed automatically when the script finishes.
?>
