<?php
session_start();
include 'db.php';

// Ensure only the admin can process requests
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit();
}

// Get request ID and action from URL parameters
$requestId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$action = $_GET['action'] ?? '';

if ($requestId > 0 && in_array($action, ['approve', 'reject'])) {
    if ($action === 'approve') {
        // Update request status to 'approved' and insert into vendors table
        $result = $conn->query("SELECT * FROM vendor_requests WHERE id = $requestId");
        $request = $result->fetch_assoc();
        $stmt = $conn->prepare("INSERT INTO vendors (name, description, category_id, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $request['name'], $request['description'], $request['category'], $request['image']);
        $stmt->execute();
        $conn->query("DELETE FROM vendor_requests WHERE id = $requestId");

    } elseif ($action === 'reject') {
        $conn->query("DELETE FROM vendor_requests WHERE id = $requestId");
    }
}

// Redirect back to admin dashboard
header("Location: admin_dashboard.php");
exit();
?>
