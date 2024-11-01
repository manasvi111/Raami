<?php
// Include database connection
include 'db.php';

session_start(); // Start the session to store user data

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Save user data to session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['user_type'] = $user['user_type'];

            // Redirect to the correct dashboard based on user type
            if ($user['user_type'] == 'couple') {
                header("Location: user_dashboard.php");
            } else {
                header("Location: vendor_dashboard.php");
            }
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No account found with that email.";
    }
}

$conn->close();
?>
