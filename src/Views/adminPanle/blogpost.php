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
        <h2 class="text-center mb-4">Create a New Blog Post</h2>
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
                <form action="AddBlog" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($this->generateCsrfToken()) ?>">
                    <!-- Blog Title -->
                    <div class="mb-3">
                        <label class="form-label">Select Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="0">Please Select Category</option>
                            <?
                            foreach($data as $val){?>
                                <option value="<?=$val['id']?>"><?=$val['name']?></option>
                            <?}?>
                            
                        </select>
                        
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingTitle" name="title" placeholder="Blog Title" required>
                        <label for="floatingTitle">Title</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingTitle" name="authername" placeholder="Author Name" required>
                        <label for="floatingTitle">Author Name</label>
                    </div>
                    <!-- Blog Description -->
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="floatingDescription" name="description" placeholder="Write a short description" style="height: 150px;" required></textarea>
                        <label for="floatingDescription">Description</label>
                    </div>

                    <!-- Blog Image -->
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload Image</label>
                        <input class="form-control" type="file" id="formFile" name="image" accept="image/*" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100">Publish Post</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 CDN for JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
