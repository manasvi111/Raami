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

// Fetch budget for the logged-in user
$stmt = $conn->prepare("SELECT total_budget, amount_spent FROM budgets WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$budget = $result->fetch_assoc();

// If no budget exists for the user, set default values
$total_budget = $budget ? $budget['total_budget'] : 0;
$amount_spent = $budget ? $budget['amount_spent'] : 0;
$remaining_budget = $total_budget - $amount_spent;
$percentage_spent = $total_budget > 0 ? ($amount_spent / $total_budget) * 100 : 0;

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
        <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
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
                                    <span class="task-text"><?= htmlspecialchars($task['task_name']); ?></span>
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
                        <p>Total Budget: $<span id="total-budget"><?= htmlspecialchars($total_budget); ?></span></p>
                        <p>Amount Spent: $<span id="amount-spent"><?= htmlspecialchars($amount_spent); ?></span></p>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?= $percentage_spent; ?>%;" aria-valuenow="<?= $percentage_spent; ?>" aria-valuemin="0" aria-valuemax="100"><?= round($percentage_spent); ?>%</div>
                        </div>
                        <button class="btn btn-primary" id="manageBudgetButton">Manage Budget</button>
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
    
    <!-- Modal for managing the budget -->
    <div class="modal fade" id="budgetModal" tabindex="-1" aria-labelledby="budgetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="budgetModalLabel">Manage Budget</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="budgetForm">
                        <div class="mb-3">
                            <label for="totalBudgetInput" class="form-label">Total Budget</label>
                            <input type="number" class="form-control" id="totalBudgetInput" value="<?= htmlspecialchars($total_budget); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="amountSpentInput" class="form-label">Amount Spent</label>
                            <input type="number" class="form-control" id="amountSpentInput" value="<?= htmlspecialchars($amount_spent); ?>" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveBudgetButton">Save</button>
                </div>
            </div>
        </div>
    </div>

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
                                    <span class="task-text">${taskName}</span>
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
                            taskElement.addClass('completed-task');
                            taskElement.find('.task-checkbox').prop('disabled', true);
                            taskElement.find('.edit-task-btn').prop('disabled', true);
                        } else {
                            taskElement.removeClass('completed-task');
                            taskElement.find('.task-checkbox').prop('disabled', false);
                            taskElement.find('.edit-task-btn').prop('disabled', false);
                        }
                    } else {
                        alert('Failed to update task');
                    }
                }, 'json');
            });
            
            // Edit task
            $(document).on('click', '.edit-task-btn', function() {
                const taskId = $(this).data('task-id');
                const taskText = $(this).closest('li').find('.task-text').text();
                const newTaskName = prompt("Edit task:", taskText);

                if (newTaskName) {
                    $.post('edit_task.php', { task_id: taskId, task_name: newTaskName }, function(data) {
                        if (data.status === 'success') {
                            $(`[data-task-id="${taskId}"]`).closest('li').find('.task-text').text(newTaskName);
                        } else {
                            alert('Failed to update task');
                        }
                    }, 'json');
                }
            });

            // Manage Budget
            $('#manageBudgetButton').click(function() {
                $('#budgetModal').modal('show');
            });

            // Save Budget
            $('#saveBudgetButton').click(function() {
                const totalBudget = $('#totalBudgetInput').val();
                const amountSpent = $('#amountSpentInput').val();

                $.post('update_budget.php', {
                    total_budget: totalBudget,
                    amount_spent: amountSpent
                }, function(data) {
                    if (data.status === 'success') {
                        $('#total-budget').text(totalBudget);
                        $('#amount-spent').text(amountSpent);
                        const percentageSpent = (amountSpent / totalBudget) * 100;
                        $('.progress-bar').css('width', percentageSpent + '%').attr('aria-valuenow', percentageSpent).text(Math.round(percentageSpent) + '%');
                        $('#budgetModal').modal('hide');
                    } else {
                        alert('Failed to update budget');
                    }
                }, 'json');
            });
        });
    </script>
</body>
</html>
