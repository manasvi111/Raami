<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="login-email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="login-email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="login-password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="login-password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Sign Up Modal -->
<div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="signUpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signUpModalLabel">Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="signup.php" method="POST">
                    <div class="mb-3">
                        <label for="signup-name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="signup-name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="signup-email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="signup-email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="signup-password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="signup-password" name="password" required>
                    </div>

                    <div class="mb-3" id="vendor-category" style="display: none;">
                        <label for="vendor-category-select" class="form-label">Select Vendor Category</label>
                        <select name="category_id" id="vendor-category-select" class="form-select">
                            <?php
                            // Fetch vendor categories from the database
                            include 'db.php';
                            $sql = "SELECT * FROM vendor_categories";
                            $result = $conn->query($sql);

                            if ($result === false) {
                                // Error in the query
                                echo '<option value="">Error fetching categories</option>';
                            } elseif ($result->num_rows > 0) {
                                // Display categories if available
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['category_name'] . '</option>';
                                }
                            } else {
                                // No categories found
                                echo '<option value="">No categories found</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to show/hide category dropdown -->
<script>
document.getElementById('user-type').addEventListener('change', function() {
    var userType = this.value;
    var categoryDropdown = document.getElementById('vendor-category');
    if (userType === 'vendor') {
        categoryDropdown.style.display = 'block'; // Show the category dropdown if vendor is selected
    } else {
        categoryDropdown.style.display = 'none'; // Hide the category dropdown if couple is selected
    }
});
</script>
