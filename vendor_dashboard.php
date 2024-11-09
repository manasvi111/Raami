<?php
session_start();

include 'db.php'; // Include database connection

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'vendor') {
    // Redirect to login if not logged in or not a vendor
    header("Location: login.php");
    exit;
}

// Fetch vendor details based on logged-in user
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM vendors WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$vendor = $result->fetch_assoc();

// If vendor does not exist, redirect to profile creation
if (!$vendor) {
    echo "Vendor profile not found. Please create your profile.";
    exit;
}
?>


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

    <title>Vendor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2>Vendor Dashboard</h2>
        <p>Welcome, <?= htmlspecialchars($_SESSION['full_name']); ?></p>

        <!-- Profile Management -->
        <h3>Profile Management</h3>
        <form action="update_vendor_profile.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Business Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($vendor['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category" name="category" value="<?= htmlspecialchars($vendor['category_id']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact Details</label>
                <input type="text" class="form-control" id="contact" name="contact" value="<?= htmlspecialchars($vendor['contact']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"><?= htmlspecialchars($vendor['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Business Image (optional)</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>

        <!-- Service Listings -->
        <h3 class="mt-5">Service Listings</h3>
        <a href="add_service.php" class="btn btn-success mb-3">Add New Service</a>

        <?php
        // Fetch services for the logged-in vendor
        $stmt = $conn->prepare("SELECT * FROM services WHERE vendor_id = ?");
        $stmt->bind_param("i", $vendor['id']);
        $stmt->execute();
        $services = $stmt->get_result();
        ?>

        <?php if ($services->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Service Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($service = $services->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($service['name']); ?></td>
                            <td><?= htmlspecialchars($service['description']); ?></td>
                            <td><?= htmlspecialchars($service['price']); ?></td>
                            <td>
                                <a href="edit_service.php?id=<?= $service['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_service.php?id=<?= $service['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No services found.</p>
        <?php endif; ?>
    </div>

    <title>User Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="users.css"> 
</head>
<body>
    <!-- Header Section -->
    <header class="bg-primary text-white p-3 text-center" style="background-color: red;">
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
                            <!-- Add more tasks as needed -->
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
    <footer class="bg-light text-center py-3">
        <p>&copy; 2024 Raami. All Rights Reserved.</p>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
