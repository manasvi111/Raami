<?php
include '../universal/db.php';
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

        // Check if user is the admin based on email
        if ($user['email'] == 'admin@outlook.com') { 
            $_SESSION['is_admin'] = true; // Set an admin flag
            header('Location: ../admin/admin_dashboard.php'); // Redirect admin to admin dashboard
        } else {
            $_SESSION['is_admin'] = false; // Not an admin
            header('Location: ../user/user_dashboard.php'); // Redirect regular users
        }
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid login credentials!";
        header('Location: ../Visitor/index.php');
        exit();
    }
}
$conn->close();
?>
