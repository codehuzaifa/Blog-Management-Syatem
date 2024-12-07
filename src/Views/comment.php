<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("headerweb.php"); ?>
    <div class="container mt-5">
        <div class="mt-4">
            <h2>Leave a Comment</h2>
            <form action="<?=ROOT_URL?>Comment" method="POST">
                <input type="hidden" name="post_id" value="<?= htmlspecialchars($_REQUEST['bpid']) ?>">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($this->generateCsrfToken()) ?>">
                
                <div class="mb-3">
                    <label for="user_name" class="form-label">Your Name</label>
                    <input type="text" name="user_name" id="user_name" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Your Comment</label>
                    <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <!-- Show Last 10 Comments -->
        <div class="mt-5">
            <h2>Recent Comments</h2>
            <?php if (!empty($comments)): ?>
                <ul class="list-group">
                    <?php foreach ($comments as $comment): ?>
                        <li class="list-group-item">
                            <strong><?= htmlspecialchars($comment['user_name']) ?>:</strong>
                            <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                            <small class="text-muted">Posted on <?= htmlspecialchars($comment['created_at']) ?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No comments yet. Be the first to comment!</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
