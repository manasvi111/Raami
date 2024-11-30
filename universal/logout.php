<?php
session_start();
session_destroy(); // Destroy the session
header("Location: ../Visitor/index.php"); // Redirect to the login page
exit();
?>
