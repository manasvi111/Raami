<?php 
session_start();
include 'db.php';

// Display success message if set
if (isset($_SESSION['request_success'])) {
    echo "<div class='alert alert-success text-center' role='alert'>";
    echo $_SESSION['request_success'];
    echo "</div>";
    unset($_SESSION['request_success']);
}

// Get category ID from the URL
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

// Fetch category name
$sql_category = "SELECT category_name FROM vendor_categories WHERE id = $category_id";
$result_category = $conn->query($sql_category);
$category_name = $result_category->fetch_assoc()['category_name'] ?? 'Unknown Category';

// Fetch vendors for the selected category
$sql_vendors = "SELECT * FROM vendors WHERE category_id = $category_id";
$result_vendors = $conn->query($sql_vendors);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Directory for <?php echo $category_name; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>

    <?php include 'header.php'; ?>
    <?php include 'modals.php'; ?>
    
    <section class="vendors-section text-center py-5">
        <h2 class="mb-3">Vendors for <?php echo $category_name; ?></h2>
        <div class="container">
            <div class="row">
                <?php
                if ($result_vendors->num_rows > 0) {
                    while ($vendor = $result_vendors->fetch_assoc()) {
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="vendor-card p-3 text-center" style="background-color: #f7e7ce;">
                            <img src="<?php echo $vendor['image']; ?>" alt="<?php echo htmlspecialchars($vendor['name']); ?>" class="img-fluid mb-3">

                                <h5><?php echo $vendor['name']; ?></h5>
                                <p><?php echo $vendor['description']; ?></p>
                                <!-- Trigger the login modal when View Details is clicked -->
                                <a class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#loginModal">View Contact Details</a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No vendors found for this category.</p>";
                }
                ?>
            </div>
        </div>
        <!-- "Want to be a Vendor?" Button -->
        <div class="text-center mt-4">
            <button type="button" class="btn custom-vendor-btn" data-bs-toggle="modal" data-bs-target="#vendorRequestModal">Want to be a Vendor?</button>
        </div>
    </section>

    <!-- Vendor Request Modal -->
    <div class="modal fade" id="vendorRequestModal" tabindex="-1" aria-labelledby="vendorRequestLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="vendor_request.php" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="vendorRequestLabel">Vendor Request Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Fields for Vendor Request -->
                        <input type="hidden" name="category" value="<?php echo $category_id; ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Upload a Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Auto-close the success message after 5 seconds
        setTimeout(function() {
            let alert = document.querySelector('.alert-success');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>

    <?php include 'footer.php' ?>
</body>
</html>

<?php
$conn->close();
?>
