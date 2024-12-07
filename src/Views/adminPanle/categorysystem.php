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
        <h2 class="text-center mb-4">Create a Category</h2>
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
                <form action="CategorySystem" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($this->generateCsrfToken()) ?>">
                    <!-- Blog Title -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingTitle" name="name" placeholder="Full Name" required>
                        <label for="floatingTitle">Category Name</label>
                    </div>                    

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100">Create Category</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h1>Category List</h1>

        <!-- Responsive Table Wrapper -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap 5 CDN for JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
