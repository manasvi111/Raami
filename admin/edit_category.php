<?php
session_start();
include '../universal/db.php';

$category_id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update category name in the database
    $new_category_name = $_POST['category_name'];
    $stmt = $conn->prepare("UPDATE vendor_categories SET category_name = ? WHERE id = ?");
    $stmt->bind_param("si", $new_category_name, $category_id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Category updated successfully!";
    } else {
        $_SESSION['error_message'] = "Failed to update category.";
    }
    $stmt->close();
    header("Location: admin_dashboard.php#manage-categories");
    exit();
} else {
    // Fetch current category name for display
    $stmt = $conn->prepare("SELECT category_name FROM vendor_categories WHERE id = ?");
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $category = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Category</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" value="<?= htmlspecialchars($category['category_name']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="admin_dashboard.php#manage-categories" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
