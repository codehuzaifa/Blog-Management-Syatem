<?php
session_start();  // Start the sessio
use App\Controllers\HomeController;
use App\Controllers\AdminController;
use App\Controllers\CommentController;
use App\Controllers\CategoryController;

use App\Router;

require_once 'vendor/autoload.php';

$router = new Router();
// Create the PDO instance
$database = new App\Database();
$pdo = $database->getConnection();

// Define multiple routes for the same controller with different methods
$router->get('/', HomeController::class, 'index');  // Route to 'index' method
$router->get('/Dashboard', HomeController::class, 'Dashboard');  // Route to 'about' method
$router->get('/MyProfile', HomeController::class, 'MyProfile');  // Route to 'about' method
$router->get('/Settings', HomeController::class, 'Settings');  // Route to 'about' method
$router->get('/ReadBlog', HomeController::class, 'ReadBlog');  // Route to 'about' method
$router->get('/Comment', HomeController::class, 'Comment');  // Route to 'about' method
$router->post('/Comment', CommentController::class, 'CommentPost');  // Route to 'about' method
$router->get('/category', CategoryController::class, 'getBlogByCaidById');  // Route to 'about' method



// For Admin Panel
$router->get('/Admin/Login', AdminController::class, 'Login');  // Route to 'about' method
$router->post('/Admin/Login', AdminController::class, 'LoginAuth');  // Route to 'about' method
$router->get('/Admin/Deactivate', AdminController::class, 'deactivate');  // Route to 'about' method
$router->get('/Admin/Delete', AdminController::class, 'deleteUsers');  // Route to 'about' method

/// User Routes
$router->get('/Admin/AddUser', AdminController::class, 'AddUser');  // Route to 'about' method
$router->post('/Admin/AddUser', AdminController::class, 'AddUserPost');  // Route to 'about' method
$router->get('/Admin/UserList', AdminController::class, 'UserList');  // Route to 'about' method

$router->get('/Admin/UserList', AdminController::class, 'UserList');  // Route to 'about' method
$router->get('/Admin/UserList', AdminController::class, 'UserList');  // Route to 'about' method

$router->get('/Admin/welcome', AdminController::class, 'welcome');  // Route to 'about' method
$router->get('/Admin/Logout', AdminController::class, 'Logout');  // Route to 'about' method
$router->get('/Admin/AddBlog', AdminController::class, 'AddBlog');  // Route to 'about' method
$router->post('/Admin/AddBlog', AdminController::class, 'AddBlogPost');  // Route to 'about' method
$router->get('/Admin/BlogList', AdminController::class, 'BlogList');  // Route to 'about' method
$router->get('/Admin/BlogSingle', AdminController::class, 'BlogSingle');  // Route to 'about' method
$router->get('/Admin/BlogDelete', AdminController::class, 'BlogDelete');  // Route to 'about' method
$router->get('/Admin/BlogSingleEdit', AdminController::class, 'BlogSingleEdit');  // Route to 'about' method
$router->post('/Admin/BlogSingleEdit', AdminController::class, 'BlogSingleEditPost');  // Route to 'about' method

$router->get('/Admin/Comment', CommentController::class, 'CommentList');  // Route to 'about' method
$router->get('/Admin/ApproveComment', CommentController::class, 'ApproveComment');  // Route to 'about' method
$router->get('/Admin/DeleteComment', CommentController::class, 'DeleteComment');  // Route to 'about' method

$router->get('/Admin/CategorySystem', CategoryController::class, 'CategorySystem');  // Route to 'about' method
$router->post('/Admin/CategorySystem', CategoryController::class, 'CategorySystemPost');  // Route to 'about' method

$router->get('/search', AdminController::class, 'searchPosts');









// Dispatch the request
$router->dispatch();
