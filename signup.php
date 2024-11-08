<?php
// Include database connection
include 'db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $user_type = $_POST['user_type'];

    // Check if the email already exists
    $sql_check = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        echo "Email is already registered!";
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO users (full_name, email, password, user_type) VALUES ('$full_name', '$email', '$password', '$user_type')";

        if ($conn->query($sql) === TRUE) {
            echo "Sign up successful!";
            header("Location: index.php"); // Redirect to home after success
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
