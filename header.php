<!-- header.php -->
<?php include 'modals.php'; ?>
<header class="shadow-sm py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="index.php" class="logo">Raami</a> <!-- Link to home page -->
        <nav class="d-flex flex-grow-1 justify-content-center">
            <a href="#vendors" class="nav-link">Vendor directory</a>
            <a href="#features" class="nav-link">Services</a>
            <a href="resources.php" class="nav-link">Resources</a>
            <a href="about.php" class="nav-link">About Us</a>
            <a href="contact.php" class="nav-link">Contact Us</a>
        </nav>
        <div>
        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#signUpModal">Sign Up</button>
        </div>
    </div>
</header>
