<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Blog Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("partial/header.php"); ?>
    <div class="container mt-5">
        <h1>Update Blog Post</h1>

        <form action="BlogSingleEdit" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                        <label class="form-label">Select Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="0">Please Select Category</option>
                            <?
                            foreach($category as $val){?>
                                <option value="<?=$val['id']?>" <?=($post['category_id']==$val['id'])?"selected":"";?>><?=$val['name']?></option>
                            <?}?>
                            
                        </select>
                        
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars($post['title']) ?>" required>
                <input type="hidden" name="pdids" class="form-control" value="<?= $post['id'] ?>">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Author Name</label>
                <input type="text" value="<?= htmlspecialchars($post['authername']) ?>" class="form-control" name="authername" placeholder="Author Name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" required><?= htmlspecialchars($post['description']) ?></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Update Image (Optional)</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*" value="<?=ROOT_URL?>/uploads/<?= htmlspecialchars($post['image']) ?>">
                <p>Current Image: <img src="../public/uploads/<?= htmlspecialchars($post['image']) ?>" width="100" height="100"></p>
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
