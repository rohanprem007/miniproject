<?php
// user/user_operations.php
session_start();
require_once '../connect/db_connect.php';

// Security check
if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access.']);
    exit();
}

$user_id = $_SESSION['user_id'];
$action = $_POST['action'] ?? '';

// --- Action Router ---

if ($action === 'delete_booking') {
    $booking_id = (int)$_POST['booking_id'];
    $stmt_pay = $conn->prepare("DELETE FROM payment WHERE bid = ?");
    $stmt_pay->bind_param("i", $booking_id);
    $stmt_pay->execute();
    $stmt_pay->close();
    $stmt = $conn->prepare("DELETE FROM booking WHERE bid = ? AND user_id = ?");
    $stmt->bind_param("ii", $booking_id, $user_id);
    if ($stmt->execute() && $stmt->affected_rows > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Booking deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete booking.']);
    }
    $stmt->close();
}

if ($action === 'book_package') {
    $package_id = (int)$_POST['package_id'];
    $booking_date = date('Y-m-d');
    $status = 'Pending';
    $stmt = $conn->prepare("INSERT INTO booking (user_id, package_id, booking_date, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $user_id, $package_id, $booking_date, $status);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Package booked successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to book package.']);
    }
    $stmt->close();
}

if ($action === 'submit_payment') {
    $booking_id = (int)$_POST['booking_id'];
    $amount = (float)$_POST['amount'];
    $payment_method = 'Credit Card'; // Example method
    $payment_date = date('Y-m-d H:i:s');
    $status = 'Completed';

    // Verify the booking belongs to the user and is CONFIRMED before processing payment
    $verify_stmt = $conn->prepare("SELECT bid FROM booking WHERE bid = ? AND user_id = ? AND status = 'Confirmed'");
    $verify_stmt->bind_param("ii", $booking_id, $user_id);
    $verify_stmt->execute();
    $result = $verify_stmt->get_result();
    
    if ($result->num_rows === 1) {
        // Insert payment record
        $pay_stmt = $conn->prepare("INSERT INTO payment (bid, payment_method, amount, payment_date, status) VALUES (?, ?, ?, ?, ?)");
        $pay_stmt->bind_param("isdss", $booking_id, $payment_method, $amount, $payment_date, $status);
        
        if ($pay_stmt->execute()) {
            // No longer need to update booking status here
            echo json_encode(['status' => 'success', 'message' => 'Payment successful! Your booking is now fully paid.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Payment failed. Please try again.']);
        }
        $pay_stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'This booking is not confirmed or has already been paid.']);
    }
    $verify_stmt->close();
}

$conn->close();
