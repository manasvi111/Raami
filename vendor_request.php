<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // Handle the image upload
    $target_dir = "uploads/"; 
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        // Insert the vendor request into the database
        $stmt = $conn->prepare("INSERT INTO vendor_requests (name, email, category, description, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $category, $description, $target_file);
        $stmt->execute();

        // Set success message
        $_SESSION['request_success'] = "Your request has been submitted for review.";
        header("Location: vendor_listing.php?category_id=" . $category);
    } else {
        // Error handling if file upload fails
        $_SESSION['request_success'] = "Your request was submitted, but the image could not be uploaded.";
        header("Location: vendor_listing.php?category_id=" . $category);
    }
    exit();
}
?>
