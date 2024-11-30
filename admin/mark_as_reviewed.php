<?php
include '../universal/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("UPDATE contact_submissions SET status = 'reviewed' WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: ../admin/admin_dashboard.php");
exit();
?>
