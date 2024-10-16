<?php
session_start();
include 'db.php'; // Include database connection

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: index.php");
    exit;
}

// Retrieve the user's name from the session
$user_name = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'User';

// Fetch tasks for the logged-in user
$user_id = $_SESSION['user_id']; // Assuming the user ID is stored in session after login
$stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$tasks = [];
while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="users.css?v=5.0"> 
</head>
<body>
    <!-- Header Section -->
    <header id="custom-header" class="text-white p-3 text-center">
        <h2>Welcome, <?php echo htmlspecialchars($user_name); ?></h2>
        <a href="#" class="btn btn-light btn-sm">Logout</a>
    </header>

    <!-- Main Dashboard Section -->
    <div class="container my-5">
        <div class="row">
            <!-- Planning Checklist -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h3 class="card-title">Personalized Planning Checklist</h3>
                        <ul class="list-group mb-3" id="task-list">
                            <?php foreach ($tasks as $task): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center <?= $task['is_completed'] ? 'completed-task' : ''; ?>">
                                <div>
                                    <input class="form-check-input me-1 task-checkbox" type="checkbox" value="<?= $task['id']; ?>" <?= $task['is_completed'] ? 'checked disabled' : ''; ?>>
                                    <?= htmlspecialchars($task['task_name']); ?>
                                </div>
                                <button class="btn btn-sm btn-warning edit-task-btn" data-task-id="<?= $task['id']; ?>" <?= $task['is_completed'] ? 'disabled' : ''; ?>>Edit</button>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <button class="btn btn-primary" id="addTaskButton">Add New Task</button>
                    </div>
                </div>
            </div>

            <!-- Budget Overview -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h3 class="card-title">Budget Overview</h3>
                        <p>Total Budget: $10,000</p>
                        <p>Amount Spent: $4,500</p>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                        </div>
                        <button class="btn btn-primary">Manage Budget</button>
                    </div>
                </div>
            </div>

            <!-- Progress Tracker -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h3 class="card-title">Progress Tracker</h3>
                        <div class="progress-circle mx-auto mb-3">
                            <span>50%</span>
                        </div>
                        <p>Overall wedding planning progress.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer id="custom-footer" class="text-center py-3">
        <p>&copy; 2024 Raami. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Add jQuery for AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add a new task
            $('#addTaskButton').click(function() {
                const taskName = prompt("Enter the new task:");
                if (taskName) {
                    $.post('add_task.php', { task_name: taskName }, function(data) {
                        if (data.status === 'success') {
                            const newTask = `<li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <input class="form-check-input me-1 task-checkbox" type="checkbox" value="${data.task_id}">
                                    ${taskName}
                                </div>
                                <button class="btn btn-sm btn-warning edit-task-btn" data-task-id="${data.task_id}">Edit</button>
                            </li>`;
                            $('#task-list').append(newTask);
                        } else {
                            alert(data.message);
                        }
                    }, 'json');
                }
            });

            // Mark task as complete/incomplete
            $(document).on('change', '.task-checkbox', function() {
                const taskId = $(this).val();
                const isCompleted = $(this).is(':checked') ? 1 : 0;
                const taskElement = $(this).closest('li');

                $.post('update_task.php', { task_id: taskId, is_completed: isCompleted }, function(data) {
                    if (data.status === 'success') {
                        if (isCompleted) {
                            // Mark as completed
                            taskElement.addClass('completed-task');
                            taskElement.find('.task-checkbox').prop('disabled', true); // Disable the checkbox
                            taskElement.find('.edit-task-btn').prop('disabled', true);  // Disable the edit button
                        } else {
                            // Mark as incomplete
                            taskElement.removeClass('completed-task');
                            taskElement.find('.task-checkbox').prop('disabled', false); // Enable the checkbox
                            taskElement.find('.edit-task-btn').prop('disabled', false);  // Enable the edit button
                        }
                    } else {
                        alert('Failed to update task');
                    }
                }, 'json');
            });
        });
    </script>
</body>
</html>
