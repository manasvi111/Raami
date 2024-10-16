<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: index.php");
    exit;
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
        <h2>Welcome, [User's Name]</h2>
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
                        <ul class="list-group mb-3">
                            <li class="list-group-item">
                                <input class="form-check-input me-1" type="checkbox" value="" aria-label="Task 1">
                                Book Venue
                            </li>
                            <li class="list-group-item">
                                <input class="form-check-input me-1" type="checkbox" value="" aria-label="Task 2">
                                Finalize Guest List
                            </li>
                            <li class="list-group-item">
                                <input class="form-check-input me-1" type="checkbox" value="" aria-label="Task 3">
                                Send Invitations
                            </li>
                        </ul>
                        <button class="btn btn-primary">Add New Task</button>
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
</body>
</html>
s