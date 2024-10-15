<?php
include 'db.php';

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
    <?php include 'header.php' ?>

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
                                <img src="path/to/vendor/image/<?php echo $vendor['image']; ?>" alt="<?php echo $vendor['name']; ?>" class="img-fluid mb-3">
                                <h5><?php echo $vendor['name']; ?></h5>
                                <p><?php echo $vendor['description']; ?></p>
                                <a href="vendor-details.php?vendor_id=<?php echo $vendor['id']; ?>" class="btn btn-outline-dark">View Details</a>
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
    </section>

    <?php include 'footer.php' ?>
</body>
</html>
<?php
$conn->close();
?>
