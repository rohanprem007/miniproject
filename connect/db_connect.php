<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Default username for WAMP
$password = "";     // Default password for WAMP is empty
$dbname = "tourism_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>