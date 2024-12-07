<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body,
        html {
            height: 100%;
        }
    </style>
</head>

<body class="d-flex flex-column">
       <!-- 404 Error Section -->
    <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-md-12 text-center">
        <h1><?=$data['code']?></h1>
		<h2><?=$data['title']?></h2>
		<p> 
			<?=$data['message']?>
		</p>
        <a href="<?= $_SERVER['REQUEST_URI'] !== '/Blog-Management-Syatem/public/' ? '/Blog-Management-Syatem/public/' : '/' ?>" class="btn btn-primary">Go Back to Home</a>

        </div>
    </div>

    <!-- Bootstrap JS (optional for dropdowns and other components) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
