<?php
$servername = "localhost";
$username = "root"; // Default XAMPP MySQL username
$password = ""; // Leave blank for XAMPP
$dbname = "raami_db"; // The database you created earlier

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
