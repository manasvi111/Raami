<?php
session_start();
include 'db.php';

// Ensure only the admin has access
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit();
}

// Fetch pending vendor requests
$pendingRequests = $conn->query("SELECT * FROM vendor_requests WHERE status = 'pending'");

// Fetch all registered users
$registeredUsers = $conn->query("SELECT * FROM users");

// Fetch all approved vendors
$approvedVendors = $conn->query("SELECT vendors.id, vendors.name, vendor_categories.category_name AS category
    FROM vendors
    JOIN vendor_categories ON vendors.category_id = vendor_categories.id");

// Fetch contact submissions
$contactSubmissions = $conn->query("SELECT * FROM contact_submissions ORDER BY submitted_at DESC");
// Fetch new contacts
$newContacts = $conn->query("SELECT * FROM contact_submissions WHERE status = 'new'");

// Fetch past (reviewed) contacts
$pastContacts = $conn->query("SELECT * FROM contact_submissions WHERE status = 'reviewed'");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin_styles.css">
   
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark ">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
    <h4 class="text-center mt-4">Menu</h4>
    <a href="#pending-requests">Pending Vendor Requests</a>
    <a href="#approved-vendors">Approved Vendors</a>   
    <a href="#new-contacts">New Contact Submissions</a>
    <a href="#past-contacts">Past Contact</a>
    <a href="#manage-categories">Manage Categories</a>
    <a href="#registered-users">Registered Users</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="container">
        <h2 class="text-center mt-4">Welcome, Admin</h2>

        <!-- Pending Vendor Requests Section -->
        <section id="pending-requests" class="my-5">
            <h3>Pending Vendor Requests</h3>
            <?php if ($pendingRequests->num_rows > 0): ?>
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($request = $pendingRequests->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($request['name']); ?></td>
                                        <td><?php echo htmlspecialchars($request['category']); ?></td>
                                        <td><?php echo htmlspecialchars($request['email']); ?></td>
                                        <td><?php echo htmlspecialchars($request['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($request['description']); ?></td>
                                        <td><img src="<?php echo htmlspecialchars($request['image']); ?>" alt="Vendor Image" style="width: 100px; height: auto;"></td>
                                        <td>
                                            <a href="process_request.php?id=<?php echo $request['id']; ?>&action=approve" class="btn btn-success btn-sm">Approve</a>
                                            <a href="process_request.php?id=<?php echo $request['id']; ?>&action=reject" class="btn btn-danger btn-sm">Reject</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-muted">No pending requests found.</p>
            <?php endif; ?>
        </section>

        <!-- Approved Vendors Section -->
        <section id="approved-vendors" class="my-5">
            <h3>Approved Vendors</h3>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Vendor ID</th>
                                <th>Name</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($vendor = $approvedVendors->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $vendor['id']; ?></td>
                                    <td><?php echo htmlspecialchars($vendor['name']); ?></td>
                                    <td><?php echo htmlspecialchars($vendor['category']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

       <!-- New Contacts Section -->
        <section id="new-contacts" class="my-5">
            <h3>New Contacts</h3>
            <?php if ($newContacts->num_rows > 0): ?>
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($contact = $newContacts->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($contact['name']); ?></td>
                                        <td><?php echo htmlspecialchars($contact['email']); ?></td>
                                        <td><?php echo htmlspecialchars($contact['message']); ?></td>
                                        <td><?php echo htmlspecialchars($contact['submitted_at']); ?></td>
                                        <td>
                                        <a href="mark_as_reviewed.php?id=<?php echo $contact['id']; ?>" class="btn btn-sm btn-review">Mark as Reviewed</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-muted">No new contacts found.</p>
            <?php endif; ?>
        </section>

        <!-- Past Contacts Section -->
        <section id="past-contacts" class="my-5">
            <h3>Past Contacts</h3>
            <?php if ($pastContacts->num_rows > 0): ?>
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($contact = $pastContacts->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($contact['name']); ?></td>
                                        <td><?php echo htmlspecialchars($contact['email']); ?></td>
                                        <td><?php echo htmlspecialchars($contact['message']); ?></td>
                                        <td><?php echo htmlspecialchars($contact['submitted_at']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-muted">No past contacts found.</p>
            <?php endif; ?>
        </section>
        <!-- Manage Categories Section -->
        <section id="manage-categories" class="my-5">
            <h3>Manage Categories</h3>
            
            <!-- Add New Category Form -->
            <form action="add_category.php" method="POST" class="mb-4">
                <div class="input-group">
                    <input type="text" name="category_name" class="form-control" placeholder="New Category Name" required>
                    <button class="btn btn-primary" type="submit">Add Category</button>
                </div>
            </form>
            
            <!-- Category List Table -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch categories from the database
                            $categories = $conn->query("SELECT * FROM vendor_categories");
                            while ($category = $categories->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$category['id']}</td>";
                                echo "<td>{$category['category_name']}</td>";
                                echo "<td>";
                                echo "<a href='edit_category.php?id={$category['id']}' class='btn btn-sm btn-warning'>Edit</a> ";
                                echo "<a href='delete_category.php?id={$category['id']}' class='btn btn-sm btn-danger'>Delete</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['success_message']; ?></div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['error_message']; ?></div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                </div>
            </div>
        </section>
        <!-- Registered Users Section -->
        <section id="registered-users" class="my-5">
            <h3>Registered Users</h3>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($user = $registeredUsers->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>
                                