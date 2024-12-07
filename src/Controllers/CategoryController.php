<?php

namespace App\Controllers;

use App\Controller;  // Make sure to include the Controller class
use App\Database;
use App\Models\User; // Import the User model
use App\Models\Blog;
use App\Models\Category;
class CategoryController extends Controller {
    private $pdo;
    private $userModel;
    private $blogModel;
    private $categoryModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userModel = new User($this->pdo);  // Initialize User model with PDO
        $this->blogModel = new Blog($this->pdo);  // Initialize Blog model with PDO
        $this->categoryModel = new Category($this->pdo);  // Initialize Blog model with PDO
    }
    public function CategorySystem(){
        $data = $this->categoryModel->getAllCategories();
        $this->Adminrender("categorysystem",$data);
    }
    public function CategorySystemPost(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrfToken($_POST['csrf_token']);
            $name = $_POST['name'];
            $this->categoryModel->addCategory($name);
            $this->regenerateCsrfToken();
            header('Location: /MVCBLOG/Admin/CategorySystem');
        }
        
    }
    public function getBlogByCaidById(){
       $id = $_REQUEST['cid'];
       $limit = 10; // Number of posts per page
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Fetch paginated posts and total posts
        $posts = $this->categoryModel->catgetPaginatedPosts($limit, $offset, $id);
        $totalPosts = $this->categoryModel->catgetTotalPosts($id);
        $totalPages = ceil($totalPosts / $limit);
       $data = [
        'posts' => $posts,
        'currentPage' => $page,
        'totalPages' => $totalPages,
    ];
       $this->render("categorywiseblog",$data);
    }
}