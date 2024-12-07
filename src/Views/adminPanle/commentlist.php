<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("partial/header.php"); ?>
<div class="container mt-5">
    <h1>Comment Moderation</h1>

    <!-- Pending Comments Section -->
    <h2>Pending Comments</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Post ID</th>
                    <th>User</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendingComments as $comment): ?>
                    <tr>
                        <td><?= htmlspecialchars($comment['id']) ?></td>
                        <td><?= htmlspecialchars($comment['post_id']) ?></td>
                        <td><?= htmlspecialchars($comment['user_name']) ?></td>
                        <td><?= htmlspecialchars($comment['content']) ?></td>
                        <td>
                            <a href="ApproveComment?id=<?= $comment['id'] ?>" class="btn btn-success">Approve</a>
                            <a href="DeleteComment?id=<?= $comment['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination for Pending Comments -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $pendingTotalPages; $i++): ?>
                <li class="page-item <?= ($i == $currentPendingPage) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&status=pending"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>

    <!-- Approved Comments Section -->
    <h2>Approved Comments</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Post ID</th>
                    <th>User</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($approvedComments as $comment): ?>
                    <tr>
                        <td><?= htmlspecialchars($comment['id']) ?></td>
                        <td><?= htmlspecialchars($comment['post_id']) ?></td>
                        <td><?= htmlspecialchars($comment['user_name']) ?></td>
                        <td><?= htmlspecialchars($comment['content']) ?></td>
                        <td>
                            <a href="DeleteComment?id=<?= $comment['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination for Approved Comments -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $approvedTotalPages; $i++): ?>
                <li class="page-item <?= ($i == $currentApprovedPage) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&status=approved"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
