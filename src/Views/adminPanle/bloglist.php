<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Blog Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("partial/header.php"); ?>
    <div class="container mt-5">
        <h1>All Blog Posts</h1>
        <a href="AddBlog" class="btn btn-primary mb-3">Create New Post</a>

        <!-- Blog Posts -->
        <div class="row">
            <?php if (count($posts) > 0): ?>
                <?php foreach ($posts as $post): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <img style="height: 312px !important;width: 100% !important;" src="../public/uploads/<?= htmlspecialchars($post['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($post['title']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                                <p class="card-text">
                                    <?=nl2br(htmlspecialchars(mb_strimwidth($post['description'], 0, 100, '...')))?>
                                </p>
                                <p class="text-muted">
                                    <small>Category :- <?= ($post['catname']) ?></small>
                                </p>
                                <p class="text-muted">
                                    <small>Published on <?= date('F j, Y, g:i a', strtotime($post['publish_date'])) ?></small>
                                </p>
                                
                                <p class="text-muted"><small>Author: <?= htmlspecialchars($post['authername']) ?></small></p>
                                <a href="BlogSingle?bpid=<?= $post['id'] ?>" class="btn btn-primary">Read More</a>
                                <a href="BlogSingleEdit?bpid=<?= $post['id'] ?>" class="btn btn-primary">Edit</a>
                                <a href="BlogDelete?bpid=<?= $post['id'] ?>" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No blog posts found.</p>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
