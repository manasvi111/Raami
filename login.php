<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user based on email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];

        // Redirect based on whether the user is the admin
        if ($user['email'] == 'admin@outlook.com') { // Replace with the admin's email
            header('Location: admin_dashboard.php'); // Redirect admin to admin dashboard
        } else {
            header('Location: user_dashboard.php'); // Regular users go to user dashboard
        }
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid login credentials!";
        header('Location: index.php');
        exit();
    }
}
$conn->close();
