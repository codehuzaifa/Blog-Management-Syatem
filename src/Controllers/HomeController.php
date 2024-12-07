<?php

namespace App\Controllers;
use App\Database;
use App\Controller;  // Make sure to include the Controller class

use App\Models\Blog;
use App\Models\Comment;

class HomeController extends Controller {
    private $pdo;
    private $blogModel;
    private $commentModel;
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->blogModel = new Blog($this->pdo);  // Initialize Blog model with PDO
        $this->commentModel = new Comment($this->pdo);  // Initialize Blog model with PDO
    }
    public function index() {
        $limit = 10; // Number of posts per page
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Fetch paginated posts and total posts
        $posts = $this->blogModel->getPaginatedPosts($limit, $offset);
        $totalPosts = $this->blogModel->getTotalPosts();
        $totalPages = ceil($totalPosts / $limit);

        // Pass data to the view
        $data = [
            'posts' => $posts,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ];

        $this->render('index',$data);  // Call the render method to load the 'index' view
    }
    public function Dashboard() {
        $this->render('index',["huzaifa","ali","Dashboard"]);
    }
    public function MyProfile() {
        $this->render('index',["huzaifa","ali","MyProfile"]);
    }
    public function Settings() {
        $this->render('index',["huzaifa","ali","Settings"]);
    }
    public function NotFound() {
        $this->render('404',["huzaifa","ali","Settings"]);
    }
    public function ReadBlog() {
        // Fetch the post by ID
        $id = $_REQUEST['bpid'];
        $post = $this->blogModel->getPostById($id);

        if ($post) {
            // Pass the post data to the view
            $data = [
                'post' => $post
            ];
            $this->render('singleblog', $data);  // Render the single post view
        } else {
            // Handle the case where the post is not found
            echo "Post not found!";
        }
    }
    public function Comment(){
        $id= $_REQUEST['bpid'];
        $comments = $this->commentModel->getLastCommentsByPostId($id);

        $data = [
            'comments' => $comments,
        ];
        $this->render("comment",$data);
    }
}
