<?php

namespace App\Controllers;
use App\Database;
use App\Controller;  // Make sure to include the Controller class

use App\Models\Blog;
use App\Models\Comment;

class CommentController extends Controller {
    private $pdo;
    private $blogModel;
    private $commentModel;
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->blogModel = new Blog($this->pdo);  // Initialize Blog model with PDO
        $this->commentModel = new Comment($this->pdo);  // Initialize Blog model with PDO
    }
    // Add a comment to a post (for users)
    public function CommentPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrfToken($_POST['csrf_token']);
            $post_id = $_POST['post_id'];
            $user_name = $_POST['user_name'];
            $content = $_POST['content'];

            $this->commentModel->addComment($post_id, $user_name, $content);
            $this->regenerateCsrfToken();
            header("Location: Comment?bpid={$post_id}"); // Redirect back to the post
            exit;
        }
    }
    public function CommentList(){
        $commentsPerPage = 10; // Number of comments per page

        // Get the current page from the URL (default to 1 if not set)
        $currentPendingPage = $_GET['page'] ?? 1;
        $currentApprovedPage = $_GET['page'] ?? 1;

        // Calculate total pages for pending comments
        $totalPendingComments = $this->commentModel->getCommentsCount(0); // 0 = Pending
        $pendingTotalPages = ceil($totalPendingComments / $commentsPerPage);

        // Calculate total pages for approved comments
        $totalApprovedComments = $this->commentModel->getCommentsCount(1); // 1 = Approved
        $approvedTotalPages = ceil($totalApprovedComments / $commentsPerPage);

        // Fetch the current page's comments
        $pendingComments = $this->commentModel->getCommentsByPage(0, $currentPendingPage, $commentsPerPage);
        $approvedComments = $this->commentModel->getCommentsByPage(1, $currentApprovedPage, $commentsPerPage);

        // Pass data to the view
        $data = [
            'pendingComments' => $pendingComments,
            'approvedComments' => $approvedComments,
            'pendingTotalPages' => $pendingTotalPages,
            'approvedTotalPages' => $approvedTotalPages,
            'currentPendingPage' => $currentPendingPage,
            'currentApprovedPage' => $currentApprovedPage
        ];

        $this->Adminrender('commentlist', $data);
    }
    public function ApproveComment(){
        $id = $_REQUEST['id'];
        $this->commentModel->approveComment($id);
        header('Location: Comment');
        exit;
    }
    public function DeleteComment() {
        $id = $_REQUEST['id'];
        $this->commentModel->deleteComment($id);
        header('Location: Comment');
        exit;
    }

}
?>