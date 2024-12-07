<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['title']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("headerweb.php"); ?>
    <div class="container mt-5">
        <h1><?= htmlspecialchars($post['title']) ?></h1>
        <p><strong>Published on:</strong> <?= date('F j, Y, g:i a', strtotime($post['publish_date'])) ?></p>
        <p><strong>Author:</strong> <?= htmlspecialchars($post['authername']) ?></p>
        <img style="width: 100% !important;height: 250px !important;" src="public/uploads/<?= htmlspecialchars($post['image']) ?>" class="img-fluid" alt="<?= htmlspecialchars($post['title']) ?>">
        <p class="mt-3"><?= nl2br(htmlspecialchars($post['description'])) ?></p>

        <a href="<?=ROOT_URL?>" class="btn btn-primary">Back to All Posts</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
