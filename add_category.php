<?php
session_start();
include 'db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'];

    // Insert the new category into the database
    $stmt = $conn->prepare("INSERT INTO vendor_categories (category_name) VALUES (?)");
    $stmt->bind_param("s", $category_name);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Category added successfully!";
    } else {
        $_SESSION['error_message'] = "Failed to add category.";
    }
    $stmt->close();
    header("Location: admin_dashboard.php#manage-categories"); // Redirect back to the admin dashboard
    exit();
}
?>
