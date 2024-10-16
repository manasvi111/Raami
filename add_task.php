<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$task_name = $_POST['task_name'];

if (!empty($task_name)) {
    $stmt = $conn->prepare("INSERT INTO tasks (user_id, task_name) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $task_name);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'task_id' => $conn->insert_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Task name cannot be empty']);
}
?>
