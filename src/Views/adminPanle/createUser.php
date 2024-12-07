<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog Post</title>
    <!-- Bootstrap 5 CDN for CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <?php include("partial/header.php"); ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Create a User</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                 <!-- Flash Message -->
                 <?php if (isset($_SESSION['flash_message'])): ?>
                        <div class="alert alert-<?= $_SESSION['flash_message']['type'] ?> alert-dismissible fade show" role="alert">
                            <?= $_SESSION['flash_message']['message'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['flash_message']); // Clear the flash message ?>
                    <?php endif; ?>
                <form action="AddUser" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($this->generateCsrfToken()) ?>">
                    <!-- Blog Title -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingTitle" name="fname" placeholder="Full Name" required>
                        <label for="floatingTitle">Full Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input  type="email" name="email" id="email" required class="form-control" placeholder="Email" required>
                        <label for="floatingTitle">Email</label>
                    </div>
                    <!-- Blog Description -->
                    <div class="form-floating mb-3">
                        <input   type="password" name="password" id="password" required class="form-control" placeholder="Password" required>
                        <label for="floatingTitle">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingConfirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                    <label for="floatingConfirmPassword">Confirm Password</label>
                    </div>
                    

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100">Create User</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 CDN for JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
