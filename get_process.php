<?php
session_start();
include 'db.php'; 

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT COUNT(*) AS total_tasks, SUM(is_completed) AS completed_tasks FROM tasks WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$task_data = $result->fetch_assoc();

$total_tasks = $task_data['total_tasks'];
$completed_tasks = $task_data['completed_tasks'];
$progress_percentage = ($total_tasks > 0) ? ($completed_tasks / $total_tasks) * 100 : 0;

echo json_encode(['status' => 'success', 'progress_percentage' => $progress_percentage]);
?>
