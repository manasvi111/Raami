<?php
include 'db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskId = $_POST['task_id'];
    $taskName = $_POST['task_name'];

    // Update task name in the database
    $stmt = $conn->prepare("UPDATE tasks SET task_name = ? WHERE id = ?");
    $stmt->bind_param("si", $taskName, $taskId);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update task']);
    }

    $stmt->close();
    $conn->close();
}
?>