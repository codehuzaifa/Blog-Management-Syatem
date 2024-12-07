<?
if(!isset($_SESSION['uid'])){
    header('Location: '.ROOT_URL.'Admin/Login');
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0);">Blog Post</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="welcome">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Blog Section
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="AddBlog">Add Blog</a></li>
                            <li><a class="dropdown-item" href="BlogList">View All Blogs</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            User Section
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="AddUser">Add User</a></li>
                            <li><a class="dropdown-item" href="UserList">Registered Users</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Comment">Comment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="CategorySystem">Category System</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=ROOT_URL?>Admin/Logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>