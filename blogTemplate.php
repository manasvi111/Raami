<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $blog_title; ?> - Raami</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your custom CSS -->
</head>
<body>

<?php include 'header.php'; ?>

<!-- Blog Post Section -->
<section id="blog-post" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4"><?php echo $blog_title; ?></h1>
                <img src="<?php echo $blog_image; ?>" class="img-fluid mb-4" alt="<?php echo $blog_title; ?>">
                <p class="lead"><?php echo $blog_lead; ?></p>
                <p><?php echo $blog_content; ?></p>
                
                <!-- Back Button -->
                <a href="resources.php" class="btn btn-outline-secondary mt-4">Back to Resources</a>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
