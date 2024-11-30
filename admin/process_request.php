<?php
session_start();
include '../universal/db.php';

// Ensure only the admin can process requests
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: ../Visitor/index.php");
    exit();
}

// Get request ID and action from URL parameters
$requestId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$action = $_GET['action'] ?? '';

if ($requestId > 0 && in_array($action, ['approve', 'reject'])) {
    if ($action === 'approve') {
        // Update the request status to 'approved' in vendor_requests table
        $conn->query("UPDATE vendor_requests SET status = 'approved' WHERE id = $requestId");

        // Fetch the approved request data
        $result = $conn->query("SELECT * FROM vendor_requests WHERE id = $requestId");
        $request = $result->fetch_assoc();

        // Insert the approved request into the vendors table
        $stmt = $conn->prepare("INSERT INTO vendors (name, email, phone, description, category_id, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $request['name'], $request['email'], $request['phone'], $request['description'], $request['category'], $request['image']);
        $stmt->execute();

    } elseif ($action === 'reject') {
        // Update the request status to 'rejected' in vendor_requests table
        $conn->query("UPDATE vendor_requests SET status = 'rejected' WHERE id = $requestId");
    }
}

// Redirect back to the admin dashboard
header("Location: ../admin/admin_dashboard.php");
exit();
?>
