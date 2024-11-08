<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$total_budget = $_POST['total_budget'];
$amount_spent = $_POST['amount_spent'];

// Update or insert budget for the user
$stmt = $conn->prepare("INSERT INTO budgets (user_id, total_budget, amount_spent) VALUES (?, ?, ?) 
                        ON DUPLICATE KEY UPDATE total_budget = VALUES(total_budget), amount_spent = VALUES(amount_spent)");
$stmt->bind_param("idd", $user_id, $total_budget, $amount_spent);
if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update budget']);
}
?>
