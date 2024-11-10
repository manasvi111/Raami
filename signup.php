<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type = $_POST['user_type'];

    $sql_check = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        $_SESSION['signup_error'] = "Email is already registered!";
        header('Location: index.php');
        exit();
    } else {
        $sql = "INSERT INTO users (full_name, email, password, user_type) VALUES ('$full_name', '$email', '$password', '$user_type')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['signup_success'] = "Sign up successful!";
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['signup_error'] = "An error occurred. Please try again!";
            header('Location: index.php');
            exit();
        }
    }
}
$conn->close();
?>
