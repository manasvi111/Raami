<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone']; // Ensure 'phone' is captured from form
    $category = $_POST['category'];
    $description = $_POST['description'];

    // Handle the image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        
        // Ensure this matches your table structure
        $stmt = $conn->prepare("INSERT INTO vendor_requests (name, email, phone, category, description, image, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
        $stmt->bind_param("ssssss", $name, $email, $phone, $category, $description, $target_file);
        $stmt->execute();

        $_SESSION['request_success'] = "Your request has been submitted for review.";
        header("Location: vendor_listing.php?category_id=" . $category);
    } else {
        $_SESSION['request_success'] = "Your request was submitted, but the image could not be uploaded.";
        header("Location: vendor_listing.php?category_id=" . $category);
    }
    exit();
}
