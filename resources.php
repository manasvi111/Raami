<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources - Raami</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your custom CSS -->
</head>
<body>

<?php include 'header.php'; ?> <!-- Including the header -->

<!-- Hero Section -->
<section id="resources-hero" class="py-5 text-center bg-light">
    <div class="container">
        <h1 class="mb-3">Wedding Planning Resources</h1>
        <p class="lead">Your go-to guide for everything wedding-related — from tips and trends to expert advice.</p>
    </div>
</section>

<!-- Blog Section -->
<section id="resources" class="py-5">
    <div class="container">
        <div class="row">

            <!-- Wedding Planning Tips -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <img src="Images/weddingPlanningTips.jpg" class="card-img-top" alt="Wedding Planning Tips">
                    <div class="card-body">
                        <h5 class="card-title">Wedding Planning Tips</h5>
                        <p class="card-text">Expert advice and guides to help you plan every detail of your big day, from budget management to timelines.</p>
                        <a href="weddingPlanningTips.php" class="btn btn-outline-primary">Read more</a>
                    </div>
                </div>
            </div>

            <!-- Vendor Spotlights -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <img src="Images/vendorSpotlight.jpg" class="card-img-top" alt="Vendor Spotlights">
                    <div class="card-body">
                        <h5 class="card-title">Vendor Spotlights</h5>
                        <p class="card-text">Meet the top wedding vendors who can make your special day unforgettable, featuring caterers, photographers, and more.</p>
                        <a href="vendorSpotlight.php" class="btn btn-outline-primary">Read more</a>
                    </div>
                </div>
            </div>

            <!-- Trends and Inspiration -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <img src="Images/TrendsInspiration.jpg" class="card-img-top" alt="Trends and Inspiration">
                    <div class="card-body">
                        <h5 class="card-title">Trends and Inspiration</h5>
                        <p class="card-text">Discover the latest wedding trends, from bridal fashion to décor, and get inspired for your dream wedding.</p>
                        <a href="trendsInspiration.php" class="btn btn-outline-primary">Read more</a>
                    </div>
                </div>
            </div>

            <!-- User Testimonials -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <img src="Images/UserTestimonials.jpg" class="card-img-top" alt="User Testimonials">
                    <div class="card-body">
                        <h5 class="card-title">User Testimonials</h5>
                        <p class="card-text">Hear from real couples who’ve planned their weddings using Raami, sharing their stories and experiences.</p>
                        <a href="user-testimonials.php" class="btn btn-outline-primary">Read more</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Call to Action (Are You a Blogger?) -->
<section id="cta" class="text-center py-5">
    <div class="container">
        <h3 class="mb-4">Are you a blogger?</h3>
        <p>We'd love to hear your voice! Become a guest blogger on Raami and share your wedding insights and stories with our readers.</p>
        <a href="contact.php" class="btn btn-outline-secondary">Become a Blogger</a>
    </div>
</section>

<?php include 'footer.php'; ?> <!-- Including the footer -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
