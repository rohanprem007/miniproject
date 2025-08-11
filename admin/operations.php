<?php
// --- OPERATIONS.PHP ---
// This file centralizes all backend CRUD (Create, Read, Update, Delete) operations.

session_start();
require_once 'db_connection.php';

// Security: Check if admin is logged in and if the request is a POST request.
if (!isset($_SESSION['admin_email']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Return a 403 Forbidden response if the conditions are not met.
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access.']);
    exit();
}

// Get the action from the POST data.
$action = $_POST['action'] ?? '';

// --- Main Action Router ---
// Directs the request to the appropriate function based on the 'action' parameter.
switch ($action) {
    // Package Management
    case 'add_package':
        add_package($conn);
        break;
    case 'get_package':
        get_package($conn);
        break;
    case 'update_package':
        update_package($conn);
        break;
    case 'delete_package':
        delete_package($conn);
        break;

    // User Management
    case 'delete_user':
        delete_user($conn);
        break;

    // Booking Management
    case 'get_booking':
        get_booking($conn);
        break;
    case 'update_booking_status':
        update_booking_status($conn);
        break;
    case 'delete_booking':
        delete_booking($conn);
        break;

    // Feedback Management
    case 'delete_feedback':
        delete_feedback($conn);
        break;
        
    // Page Content Management
    case 'get_page_content':
        get_page_content($conn);
        break;
    case 'update_page_content':
        update_page_content($conn);
        break;

    default:
        // Handle unknown actions.
        echo json_encode(['status' => 'error', 'message' => 'Invalid action specified.']);
        break;
}

$conn->close();

// --- Function Definitions ---

/**
 * Adds a new tour package to the database.
 * @param mysqli $conn The database connection object.
 */
function add_package($conn) {
    // Extract and sanitize data from the POST request.
    $name = $conn->real_escape_string($_POST['package_name']);
    $desc = $conn->real_escape_string($_POST['description']);
    $price = (float)$_POST['price'];
    $duration = $conn->real_escape_string($_POST['duration']);
    $destination = $conn->real_escape_string($_POST['destination']);

    // Prepare and execute the SQL statement.
    $sql = "INSERT INTO package (package_name, description, price, duration, destination) VALUES ('$name', '$desc', '$price', '$duration', '$destination')";
    if ($conn->query($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Package added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add package: ' . $conn->error]);
    }
}

/**
 * Retrieves the details of a specific package.
 * @param mysqli $conn The database connection object.
 */
function get_package($conn) {
    $id = (int)$_POST['id'];
    $sql = "SELECT * FROM package WHERE package_id = $id";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $package = $result->fetch_assoc();
        echo json_encode(['status' => 'success', 'data' => $package]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Package not found.']);
    }
}

/**
 * Updates an existing package in the database.
 * @param mysqli $conn The database connection object.
 */
function update_package($conn) {
    // Extract and sanitize data.
    $id = (int)$_POST['package_id'];
    $name = $conn->real_escape_string($_POST['package_name']);
    $desc = $conn->real_escape_string($_POST['description']);
    $price = (float)$_POST['price'];
    $duration = $conn->real_escape_string($_POST['duration']);
    $destination = $conn->real_escape_string($_POST['destination']);

    // Prepare and execute the SQL statement.
    $sql = "UPDATE package SET package_name='$name', description='$desc', price='$price', duration='$duration', destination='$destination' WHERE package_id=$id";
    if ($conn->query($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Package updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update package: ' . $conn->error]);
    }
}

/**
 * Deletes a package from the database.
 * @param mysqli $conn The database connection object.
 */
function delete_package($conn) {
    $id = (int)$_POST['id'];
    $sql = "DELETE FROM package WHERE package_id = $id";
    if ($conn->query($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Package deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete package.']);
    }
}

/**
 * Deletes a user from the database.
 * @param mysqli $conn The database connection object.
 */
function delete_user($conn) {
    $id = (int)$_POST['id'];
    $sql = "DELETE FROM users WHERE user_id = $id";
    if ($conn->query($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'User deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete user.']);
    }
}

/**
 * Retrieves details for a specific booking.
 * @param mysqli $conn The database connection object.
 */
function get_booking($conn) {
    $id = (int)$_POST['id'];
    $sql = "SELECT b.bid, b.status, u.uname, p.package_name 
            FROM booking b
            JOIN users u ON b.user_id = u.user_id
            JOIN package p ON b.package_id = p.package_id
            WHERE b.bid = $id";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $booking = $result->fetch_assoc();
        echo json_encode(['status' => 'success', 'data' => $booking]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Booking not found.']);
    }
}

/**
 * Updates the status of a booking.
 * @param mysqli $conn The database connection object.
 */
function update_booking_status($conn) {
    $id = (int)$_POST['booking_id'];
    $status = $conn->real_escape_string($_POST['status']);
    $sql = "UPDATE booking SET status = '$status' WHERE bid = $id";
    if ($conn->query($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Booking status updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update booking status.']);
    }
}

/**
 * Deletes a booking from the database.
 * @param mysqli $conn The database connection object.
 */
function delete_booking($conn) {
    $id = (int)$_POST['id'];
    $sql = "DELETE FROM booking WHERE bid = $id";
    if ($conn->query($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Booking deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete booking.']);
    }
}

/**
 * Deletes a feedback entry from the database.
 * @param mysqli $conn The database connection object.
 */
function delete_feedback($conn) {
    $id = (int)$_POST['id'];
    $sql = "DELETE FROM feedback WHERE feedback_id = $id";
    if ($conn->query($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Feedback deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete feedback.']);
    }
}


?>
