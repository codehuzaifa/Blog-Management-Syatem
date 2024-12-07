<?php

namespace App\Controllers;

use App\Controller;  // Make sure to include the Controller class
use App\Database;
use App\Models\User; // Import the User model
use App\Models\Blog;
use App\Models\Category;
class AdminController extends Controller {
    private $pdo;
    private $userModel;
    private $blogModel;
    private $categoryModel;
    protected $dependency;

    public function __construct($pdo) {
        // print_r($pdo);
        $this->pdo = $pdo;
        $this->userModel = new User($this->pdo);  // Initialize User model with PDO
        $this->blogModel = new Blog($this->pdo);  // Initialize Blog model with PDO
        $this->categoryModel = new Category($this->pdo);  // Initialize Blog model with PDO
    }
    public function Login() {
        $this->Adminrender('login');  // Call the render method to load the 'index' view
    }
    public function register() {
        $this->Adminrender('register');  // Call the render method to load the 'index' view
    }
    public function registerPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             // Get the data from the form
            //  print_r($_POST);
             $fname = $_POST['fname'];
             $email = $_POST['email'];
             $password = $_POST['password'];
             $confirmPassword = $_POST['confirmPassword'];
 
             // Validate data (check if passwords match, etc.)
             if ($password !== $confirmPassword) {
                $decode = ["error"=>200,"message"=>"User Registered Successfully. "];
                $_SESSION['flash_message'] = [
                    'type' => 'danger',
                    'message' => 'Passwords do not match!'
                ];
                $this->Adminrender('register',$decode);
                exit;
             }
             $exist = $this->userModel->create($fname,$email,$password);
             $decode = json_decode($exist,true);
             if($decode['error']!="200"){
                $_SESSION['flash_message'] = [
                    'type' => 'danger',
                    'message' => $decode['message']
                ];
                $this->Adminrender('register',$decode);
             }else{
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => $decode['message']
                ];
                $this->Adminrender('login');
             }
             
        }
    }
    public function LoginAuth(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $login = $this->userModel->authenticate($email,$password);
            $login = json_decode($login,true);
            if($login['error']=="200"){
                $_SESSION['uid'] = $login['uid'];
                $this->Adminrender('welcome');
            }else{
                $_SESSION['flash_message'] = [
                    'type' => 'danger',
                    'message' => $login['message']
                ];
                $this->Adminrender('login');
            }
        }
    }
    public function welcome() {
        $this->Adminrender('welcome');  // Call the render method to load the 'index' view
    }
    public function Logout() {
        session_destroy();
        header('Location: /Blog-Management-Syatem/Admin/Login'); // Call the render method to load the 'index' view
    }
    public function AddBlog() {
        $data = $this->categoryModel->getAllCategories();
        $this->Adminrender('blogpost',$data);  // Call the render method to load the 'index' view
    }
    public function AddBlogPost(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrfToken($_POST['csrf_token']);
            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = $_FILES['image'];
            $category_id = $_POST['category_id'];
            $publish_date = date("Y/m/d H:i:s");
            $authername = $_POST['authername'];
            // Handle image upload
            $targetDir = __DIR__ ."/../../public/uploads/";
            $imageName = time() . "_" . basename($image['name']);
            $targetFilePath = $targetDir . $imageName;

            if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
                $this->blogModel->createPost($title, $description, $imageName,$authername,$category_id);
                $this->regenerateCsrfToken();
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => "Blog Added Successfully."
                ];
                header('Location: /Blog-Management-Syatem/Admin/AddBlog');
                exit;
            } else {
                $_SESSION['flash_message'] = [
                    'type' => 'danger',
                    'message' => "Failed to upload image."
                ];
                header('Location: /Blog-Management-Syatem/Admin/AddBlog');
                exit;
            }
        }
        
    }
    public function BlogList(){
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

        $this->Adminrender('bloglist', $data);  // Render the view with data
    }
    public function BlogSingle() {
        // Fetch the post by ID
        $id = $_REQUEST['bpid'];
        $post = $this->blogModel->getPostById($id);
        $dataCategory = $this->categoryModel->getAllCategories();
        if ($post) {
            // Pass the post data to the view
            $data = [
                'post' => $post,
                'category' => $dataCategory,
            ];
            $this->Adminrender('singlepost', $data);  // Render the single post view
        } else {
            // Handle the case where the post is not found
            echo "Post not found!";
        }
    }
    public function BlogDelete() {
        // Fetch the post by ID
        $id = $_REQUEST['bpid'];
        $post = $this->blogModel->deletePost($id);

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

            $this->Adminrender('bloglist', $data);  // Render the view with data
        
    }
    public function BlogSingleEdit() {
        // Fetch the post by ID
        $id = $_REQUEST['bpid'];
        $post = $this->blogModel->getPostById($id);
        $dataCategory = $this->categoryModel->getAllCategories();
        if ($post) {
            // Pass the post data to the view
            $data = [
                'post' => $post,
                'category' => $dataCategory,
            ];
            $this->Adminrender('editsinglepost', $data);  // Render the single post view
        } else {
            // Handle the case where the post is not found
            echo "Post not found!";
        }
    }
    public function BlogSingleEditPost(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id         = $_POST['pdids'];
            $authername = $_POST['authername'];
            $title      = $_POST['title'];
            $description= $_POST['description'];
            $category_id = $_POST['category_id'];
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;

            try {
                $this->blogModel->updatePost($id, $title, $description, $image,$authername,$category_id);  // Update post in the database
                $this->BlogList();
                exit;
            } catch (\Exception $e) {
                echo $e->getMessage();  // Handle errors (e.g., image validation errors)
            }
            // Render the form with the current blog post data
            $post = $this->blogModel->getPostById($id);
            $data = [
                'post' => $post
            ];
            $this->Adminrender('editsinglepost', $data); 
        }        
    }
    public function AddUser() {
        $this->Adminrender('createUser');  // Call the render method to load the 'index' view
    }
    public function AddUserPost(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrfToken($_POST['csrf_token']);
            // Get the data from the form
           //  print_r($_POST);
            $fname = $_POST['fname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];

            // Validate data (check if passwords match, etc.)
            if ($password !== $confirmPassword) {
               $decode = ["error"=>200,"message"=>"User Registered Successfully. "];
               $_SESSION['flash_message'] = [
                   'type' => 'danger',
                   'message' => 'Passwords do not match!'
               ];
               $this->AddUser();
               exit;
            }
            $exist = $this->userModel->create($fname,$email,$password);
            $this->regenerateCsrfToken();
            $decode = json_decode($exist,true);
            if($decode['error']!="200"){
               $_SESSION['flash_message'] = [
                   'type' => 'danger',
                   'message' => $decode['message']
               ];
               $this->AddUser();
            }else{
               $_SESSION['flash_message'] = [
                   'type' => 'success',
                   'message' => $decode['message']
               ];
               $this->AddUser();
            }
            
       }
    }
    public function UserList(){
        $users = $this->userModel->getAllUsers();

        $data = [
            'users' => $users,
        ];

        $this->Adminrender('userList', $data);
    }
    // Deactivate a user
    public function deactivate() {
        $id = $_REQUEST['id'];
        $this->userModel->deactivateUser($id);
        header('Location: /Blog-Management-Syatem/Admin/UserList');
        exit;
    }

    // Delete a user
    public function deleteUsers() {
        $id = $_REQUEST['id'];
        $this->userModel->deleteUser($id);
        $this->UserList();
        exit;
    }
    public function getAllcat(){
        $dataCategory = $this->categoryModel->getAllCategories();
        return $dataCategory;
    }
    public function getCategoryById($id){
        $data = $this->categoryModel->getCategoryById($id);
        return $data;
    }
    public function searchPosts()
    {
        if (isset($_GET['query'])) {
            $query = $_GET['query'];
            $posts = $this->blogModel->searchPosts($query);

            // Return the results as JSON
            echo json_encode($posts);
        }
    }
   
}
