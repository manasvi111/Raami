<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO contact_submissions (name, email, message, submitted_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Thank you for contacting us! We will get back to you soon.";
    } else {
        $_SESSION['error_message'] = "There was an issue submitting your message. Please try again.";
    }

    $stmt->close();
    $conn->close();

    header("Location: contact.php"); // Redirect back to the contact page
    exit();
}
?>
