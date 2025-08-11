<?php
session_start();
require_once 'db_connection.php';

// Security: Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all feedback with user details
$sql = "SELECT f.feedback_id, f.feedback_text, f.submitted_at, u.uname 
        FROM feedback f
        JOIN users u ON f.user_id = u.user_id
        ORDER BY f.submitted_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Feedback - Admin</title>
    <link rel="stylesheet" href="admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<div class="dashboard-layout">
    <?php include 'sidebar.php'; ?>
    <div class="main-container">
        <header class="main-header">
            <button class="mobile-menu-button" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>
            <h1 class="page-title">Customer Feedback</h1>
        </header>
        <main>
            <div class="content-section">
                <h3>All Submitted Feedback</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Feedback ID</th>
                                <th>Submitted By</th>
                                <th>Feedback</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="feedbackTableBody">
                            <?php if ($result && $result->num_rows > 0): ?>
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr data-id="<?php echo $row['feedback_id']; ?>">
                                        <td><?php echo htmlspecialchars($row['feedback_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['uname']); ?></td>
                                        <td class="feedback-text" title="<?php echo htmlspecialchars($row['feedback_text']); ?>"><?php echo htmlspecialchars($row['feedback_text']); ?></td>
                                        <td><?php echo date("d M, Y h:i A", strtotime($row['submitted_at'])); ?></td>
                                        <td class="actions">
                                            <!-- The delete button now has a specific class and the data-id is on the parent <tr> -->
                                            <button class="action-btn delete delete-feedback-btn" title="Delete Feedback"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No feedback found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="admin_script.js"></script>
</body>
</html>
