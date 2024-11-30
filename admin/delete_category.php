<?php
session_start();
include '../universal/db.php';

$category_id = $_GET['id'];

// Delete the category from the database
$stmt = $conn->prepare("DELETE FROM vendor_categories WHERE id = ?");
$stmt->bind_param("i", $category_id);

if ($stmt->execute()) {
    $_SESSION['success_message'] = "Category deleted successfully!";
} else {
    $_SESSION['error_message'] = "Failed to delete category.";
}

$stmt->close();
header("Location: ../admin/admin_dashboard.php#manage-categories"); // Redirect back to the admin dashboard
exit();
?>
