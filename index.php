<?php
// Include database connection
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raami | Your Wedding, Simplified</title>
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
    <!-- Header Section -->
    <header class="shadow-sm py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="index.php" class="logo">Raami</a> <!-- Link to home page -->
        <nav class="d-flex flex-grow-1 justify-content-center">
            <a href="#vendors" class="nav-link">Vendor directory</a>
            <a href="#features" class="nav-link">Services</a>
            <a href="resources.php" class="nav-link">Resources</a>
            <a href="#testimonials" class="nav-link">About Us</a>
            <a href="contact.php" class="nav-link">Contact Us</a>
        </nav>
        <div>
        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#signUpModal">Sign Up</button>
        </div>
    </div>
</header>
<?php include 'modals.php'; ?>
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

    <!--Vendors and their services-->
    <section class="vendors-section text-center py-5" id="vendors">
        <h2 class="mb-3">Explore vendors for every event</h2>
        <p class="mb-5">Discover top-rated pros for any budget, background and style.</p>

        <div class="container">
            <div class="row">
                <!-- Photographer Card -->
                <div class="col-md-4 mb-4">
                    <div class="vendor-card p-3 text-center" style="background-color: #cce5ff;">
                        <img src="Images/weddingphoto.jpg" alt="Photographers" class="img-fluid mb-3" loading="lazy">
                        <h5>Photographers</h5>
                        <p>Browse galleries to find your look.</p>
                        <a href="vendor_listing.php?category_id=1" class="btn btn-outline-dark">See photographers</a>
                    </div>
                </div>
                <!-- Outdoor Spaces Card -->
                <div class="col-md-4 mb-4">
                    <div class="vendor-card p-3 text-center" style="background-color: #e2e6ea;">
                        <img src="Images/decoraters.jpg" alt="Outdoor Spaces" class="img-fluid mb-3" loading="lazy">
                        <h5>Decoraters</h5>
                        <p>See outdoor spaces for your event.</p>
                        <a href="vendor_listing.php?category_id=4" class="btn btn-outline-dark">See Decoraters</a>
                    </div>
                </div>
                <!-- Cakes Card -->
                <div class="col-md-4 mb-4">
                    <div class="vendor-card p-3 text-center" style="background-color: #ffeeba;">
                        <img src="Images/cakes.jpg" alt="Cakes" class="img-fluid mb-3" loading="lazy">
                        <h5>Cakes</h5>
                        <p>Meet bakers and set up tastings.</p>
                        <a href="vendor_listing.php?category_id=2" class="btn btn-outline-dark">Browse Bakers</a>
                    </div>
                </div>
                <!-- DJs Card -->
                <div class="col-md-4 mb-4">
                    <div class="vendor-card p-3 text-center" style="background-color: #ffdfba;">
                        <img src="Images/DJs.jpg" alt="DJs" class="img-fluid mb-3" loading="lazy">
                        <h5>DJs</h5>
                        <p>Keep your dance floor moving.</p>
                        <a href="vendor_listing.php?category_id=3" class="btn btn-outline-dark">See DJs</a>
                    </div>
                </div>
                <!-- Caterers -->
                <div class="col-md-4 mb-4">
                    <div class="vendor-card p-3 text-center" style="background-color: #d4edda;">
                        <img src="Images/caterers.jpg" alt="Venues" class="img-fluid mb-3" loading="lazy">
                        <h5>Caterers</h5>
                        <p>Find the perfect venue for your vibe.</p>
                        <a href="vendor_listing.php?category_id=7" class="btn btn-outline-dark">Browse Cateres</a>
                    </div>
                </div>
                <!-- Beauty -->
                <div class="col-md-4 mb-4">
                    <div class="vendor-card p-3 text-center" style="background-color: #f5f4b6;">
                        <img src="Images/beauty.jpg" alt="Venues" class="img-fluid mb-3" loading="lazy">
                        <h5>Beauty</h5>
                        <p>Find the perfect venue for your vibe.</p>
                        <a href="vendor_listing.php?category_id=6" class="btn btn-outline-dark">Browse more</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Plan your wedding -->
    <section id="features" class="py-5">
        <div class="container text-center">
            <h2 class="mb-5">Plan your wedding</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <div class="card-body">
                            <h3 class="card-title">Budget Planner</h3>
                            <p class="card-text">Keep your wedding budget under control.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <div class="card-body">
                            <h3 class="card-title">Task Management</h3>
                            <p class="card-text">Stay organized with our detailed task list.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <div class="card-body">
                            <h3 class="card-title">Process Tracker</h3>
                            <p class="card-text">Connect with the best vendors in your area.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Testimonials-->
    <section id="testimonials" class="py-5">
        <div class="container text-center">
        <h2 class="mb-5">
            <a href="about.php" style="text-decoration: none; color: inherit;">What Our Clients Say</a>
        </h2>
          <div id="testimonialCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <!-- Testimonial 1 -->
              <div class="carousel-item active">
                <blockquote class="blockquote">
                  <p class="mb-4">"Raami made my wedding planning stress-free and enjoyable! Highly recommended!"</p>
                  <footer class="blockquote-footer">John Doe</footer>
                </blockquote>
              </div>
              <!-- Testimonial 2 -->
              <div class="carousel-item">
                <blockquote class="blockquote">
                  <p class="mb-4">"Thanks to Raami, we found the perfect vendors within our budget. A lifesaver!"</p>
                  <footer class="blockquote-footer">Emily Rose</footer>
                </blockquote>
              </div>
              <!-- Testimonial 3 -->
              <div class="carousel-item">
                <blockquote class="blockquote">
                  <p class="mb-4">"The platform was easy to use, and the team was incredibly helpful. Loved the experience!"</p>
                  <footer class="blockquote-footer">Michael Smith</footer>
                </blockquote>
              </div>
            </div>
            <a class="carousel-control-prev" href="#testimonialCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#testimonialCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
          </div>
        </div>
      </section>      
      <!--Footer -->
      <?php include 'footer.php' ?>      
           
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
$conn->close();
?>