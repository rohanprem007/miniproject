<?php
session_start();
require_once 'db_connection.php';

// Security: Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all packages to display in the table
$sql = "SELECT * FROM package ORDER BY package_id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages - Admin</title>
    <link rel="stylesheet" href="admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<div class="dashboard-layout">
    <?php include 'sidebar.php'; ?>
    <div class="main-container">
        <header class="main-header">
            <button class="mobile-menu-button" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>
            <h1 class="page-title">Manage Tour Packages</h1>
        </header>
        <main>
            <div class="content-section">
                <div class="content-header">
                    <h3>Available Packages</h3>
                    <!-- This button now correctly triggers the modal for adding a new package -->
                    <button class="add-new-btn" id="addNewPackageBtn"><i class="fas fa-plus"></i> Add New Package</button>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Package Name</th>
                                <th>Destination</th>
                                <th>Price</th>
                                <th>Duration</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="packagesTableBody">
                            <?php if ($result && $result->num_rows > 0): ?>
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr data-id="<?php echo $row['package_id']; ?>">
                                        <td><?php echo htmlspecialchars($row['package_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['destination']); ?></td>
                                        <td>₹<?php echo number_format($row['price'], 2); ?></td>
                                        <td><?php echo htmlspecialchars($row['duration']); ?></td>
                                        <td class="actions">
                                            <button class="action-btn edit edit-package-btn" title="Edit Package"><i class="fas fa-pencil-alt"></i></button>
                                            <button class="action-btn delete delete-package-btn" title="Delete Package"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">No packages found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal for Add/Edit Package -->
<!-- This modal is hidden by default and appears when the "Add" or "Edit" button is clicked. -->
<div id="packageModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2 id="modalTitle">Add New Package</h2>
        <form id="packageForm">
            <input type="hidden" id="packageId" name="package_id">
            <div class="form-group">
                <label for="packageName">Package Name</label>
                <input type="text" id="packageName" name="package_name" required>
            </div>
            <div class="form-group">
                <label for="destination">Destination</label>
                <input type="text" id="destination" name="destination" required>
            </div>
            <div class="form-group">
                <label for="price">Price (₹)</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="duration">Duration</label>
                <input type="text" id="duration" name="duration" placeholder="e.g., 5 Days / 4 Nights" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <button type="submit" class="submit-btn" id="savePackageBtn">Save Package</button>
        </form>
    </div>
</div>

<script src="./admin_script.js"></script>
</body>
</html>
