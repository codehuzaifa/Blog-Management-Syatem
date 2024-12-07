<style>
    #suggestions {
        border: 1px solid #ccc;
        max-height: 200px;
        overflow-y: auto;
        position: absolute;
        background-color: white;
        width: 100%;
        display: none;
        z-index: 1000; /* Ensure it appears above other elements */
    }
    #suggestions li {
        padding: 8px;
        cursor: pointer;
    }
    #suggestions li:hover {
        background-color: #f0f0f0;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <?php
    use App\Controllers\AdminController;
    use App\Database;

    $db = new Database();
    $pdo = $db->getConnection();
    $menuController = new AdminController($pdo);
    $menuItems = $menuController->getAllcat(); // Fetch categories
    ?>
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0);">Blog Post</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= ROOT_URL ?>">Dashboard</a>
                </li>
                <!-- Dynamic Categories -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <?php
                        if (!empty($menuItems)) {
                            foreach ($menuItems as $category) {
                                echo "<li><a class='dropdown-item' href='" . ROOT_URL . "category?cid={$category['id']}'>{$category['name']}</a></li>";
                            }
                        } else {
                            echo "<li><a class='dropdown-item disabled' href='#'>No categories available</a></li>";
                        }
                        ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary" target="_blank" href="<?= ROOT_URL ?>Admin/Login">Login</a>
                </li>
            </ul>

            <!-- Search Bar -->
            <form class="d-flex ms-3 position-relative" action="<?= ROOT_URL ?>/search_results.php" method="GET">
                <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search" id="search" name="query">
                <ul id="suggestions" class="list-unstyled position-absolute w-100"></ul>
                <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
            </form>
        </div>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').keyup(function() {
            var query = $(this).val();

            if (query.length > 2) { // Minimum length of 3 characters before sending the request
                $.ajax({
                    url: 'Blog-Management-Syatem/search',  // Route to the search action
                    method: 'GET',
                    data: { query: query },
                    success: function(response) {
                        var results = JSON.parse(response);
                        var suggestions = '';

                        if (results.length > 0) {
                            results.forEach(function(post) {
                                suggestions += `<li><a href="ReadBlog?bpid=${post.id}">${post.title}</a></li>`;
                            });
                            $('#suggestions').html(suggestions).show();
                        } else {
                            $('#suggestions').html('<li>No posts found</li>').show();
                        }
                    }
                });
            } else {
                $('#suggestions').hide();
            }
        });

        // Hide suggestions when clicking outside
        $(document).on('click', function() {
            $('#suggestions').hide();
        });

        // Prevent hiding suggestions when clicking inside the search bar
        $('#search').click(function(e) {
            e.stopPropagation();
        });
    });
</script>
