<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Bootstrap 5.3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <main>
        <div class="container col-xl-10 col-xxl-8 px-4 py-5">
            <div class="row align-items-center g-lg-5 py-5">
                <div class="col-md-10 mx-auto col-lg-5">
                    <!-- Flash Message -->
                    <?php if (isset($_SESSION['flash_message'])): ?>
                        <div class="alert alert-<?= $_SESSION['flash_message']['type'] ?> alert-dismissible fade show" role="alert">
                            <?= $_SESSION['flash_message']['message'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['flash_message']); // Clear the flash message ?>
                    <?php endif; ?>
                    <form class="p-4 p-md-5 border rounded-3 bg-light" action="register" method="POST">
                        <h2 class="text-center">Register</h2>

                        <!-- Full Name -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingName" name="fname" placeholder="Full Name" required>
                            <label for="floatingName">Full Name</label>
                        </div>

                        <!-- Email Address -->
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="name@example.com" required>
                            <label for="floatingEmail">Email address</label>
                        </div>

                        <!-- Password -->
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingConfirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                            <label for="floatingConfirmPassword">Confirm Password</label>
                        </div>

                        <!-- Submit Button -->
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>

                        <hr class="my-4">

                        <!-- Login Link -->
                        <div class="d-flex justify-content-between mt-3">
                            <a href="Login" class="btn btn-secondary">Already have an account? Login</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>
