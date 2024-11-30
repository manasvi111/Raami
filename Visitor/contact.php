<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Raami</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
<!-- Header Section -->
<?php include '../universal/header.php'; ?>
<div class="container mt-3">
    <?php if (isset($_SESSION['success_message'])): ?>
        <div id="message-box" class="alert alert-success text-center">
            <?php echo $_SESSION['success_message']; ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php elseif (isset($_SESSION['error_message'])): ?>
        <div id="message-box" class="alert alert-danger text-center">
            <?php echo $_SESSION['error_message']; ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
</div>
<!-- Contact Us Section -->
<section id="contact" class="contact-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">Get In Touch</h2>
        <p class="text-center mb-5">We would love to hear from you. Please reach out with any questions or comments!</p>
        
        <div class="row">
           <!-- Contact Form -->
            <div class="col-md-6 mb-4">
                <form action="../Visitor/submit_contact.php" method="POST">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary custom-cta">Send Message</button>
                </form>
            </div>


            <!-- Contact Information -->
            <div class="col-md-6 mb-4">
                <h5>Contact Information</h5>
                <p><strong>Address:</strong> 123 Wedding Street, City, Country</p>
                <p><strong>Email:</strong> info@raami.com</p>
                <p><strong>Phone:</strong> +1 (234) 567-890</p>

                <!-- Social Media Links -->
                <h5 class="mt-4">Follow Us</h5>
                <a href="#" class="text-muted mx-2"><i class="fab fa-facebook fa-lg"></i></a>
                <a href="#" class="text-muted mx-2"><i class="fab fa-twitter fa-lg"></i></a>
                <a href="#" class="text-muted mx-2"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="#" class="text-muted mx-2"><i class="fab fa-linkedin fa-lg"></i></a>
            </div>
        </div>
    </div>
</section>
<script>
    // Auto-hide message after 5 seconds
    setTimeout(function() {
        let messageBox = document.getElementById('message-box');
        if (messageBox) {
            messageBox.style.display = 'none';
        }
    }, 5000); // 5 seconds
</script>
<!--Footer-->
<?php include '../universal/footer.php' ?>    

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
