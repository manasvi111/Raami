<?php
// You can initialize variables or session data here if needed
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raami | Your Wedding, Simplified</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Header Section -->
    <header class="shadow-sm py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">Raami</div>
            <nav class="d-flex flex-grow-1 justify-content-center">
                <a href="#features" class="nav-link">Plan your wedding</a>
                <a href="#how-it-works" class="nav-link">Expert advice</a>
                <a href="#testimonials" class="nav-link">Vendor directory</a>
                <a href="#vendor" class="nav-link"></a>
            </nav>
            <div>
                <button class="btn btn-outline-primary">Login</button>
                <button class="btn btn-outline-secondary">Sign Up</button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="hero" class="py-5 text-center">
        <video autoplay muted loop class="bg-video">
            <source src="Videos/wearRing.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="container">
            <h1 class="display-4">Your Wedding, Simplified</h1>
            <p class="lead">From dream to reality—Raami helps you plan every detail effortlessly.</p>
            <button class="btn btn-primary btn-lg m-2 custom-cta">Start Planning Stress-Free</button>
            <button class="btn btn-outline-light btn-lg m-2 custom-cta-outline">Discover Your Perfect Vendors</button>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container text-center">
            <h2 class="mb-5">Plan your wedding</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title">Vendor Directory</h3>
                            <p class="card-text">Connect with the best vendors in your area.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title">Task Management</h3>
                            <p class="card-text">Stay organized with our detailed task list.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title">Budget Planner</h3>
                            <p class="card-text">Keep your wedding budget under control.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
