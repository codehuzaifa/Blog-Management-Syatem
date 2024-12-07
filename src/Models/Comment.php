<?php

namespace App\Models;

use PDO;

class Comment {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Add a comment to a post
    public function addComment($post_id, $user_name, $content) {
        $stmt = $this->pdo->prepare("INSERT INTO comments (post_id, user_name, content) VALUES (:post_id, :user_name, :content)");
        $stmt->execute([
            'post_id' => $post_id,
            'user_name' => $user_name,
            'content' => $content,
        ]);
    }

    // Fetch comments by approval status
    public function getComments($isApproved = null) {
        $query = "SELECT * FROM comments";
        if ($isApproved !== null) {
            $query .= " WHERE is_approved = :is_approved";
        }
        $stmt = $this->pdo->prepare($query);
        if ($isApproved !== null) {
            $stmt->bindParam(':is_approved', $isApproved, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Approve a comment
    public function approveComment($id) {
        $stmt = $this->pdo->prepare("UPDATE comments SET is_approved = 1 WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    // Delete a comment
    public function deleteComment($id) {
        $stmt = $this->pdo->prepare("DELETE FROM comments WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
    public function getLastCommentsByPostId($post_id, $limit = 10) {
        $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE post_id = :post_id AND is_approved = 1 ORDER BY created_at DESC LIMIT :limit");
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCommentsCount($isApproved) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM comments WHERE is_approved = :is_approved");
        $stmt->bindParam(':is_approved', $isApproved, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // Fetch comments by approval status (with pagination)
    public function getCommentsByPage($isApproved, $page, $limit) {
        $offset = ($page - 1) * $limit;
        $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE is_approved = :is_approved ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':is_approved', $isApproved, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
