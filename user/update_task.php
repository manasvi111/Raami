<?php
session_start();
include '../universal/db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

$task_id = $_POST['task_id'];
$is_completed = $_POST['is_completed'];

$stmt = $conn->prepare("UPDATE tasks SET is_completed = ? WHERE id = ? AND user_id = ?");
$stmt->bind_param("iii", $is_completed, $task_id, $_SESSION['user_id']);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update task']);
}
?>
