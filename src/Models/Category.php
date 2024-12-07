<?php

namespace App\Models;

use PDO;

class Category {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Get all categories
    public function getAllCategories() {
        $stmt = $this->pdo->query("SELECT * FROM categories ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a category by ID
    public function getCategoryById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add a new category
    public function addCategory($name) {
        $stmt = $this->pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
        $stmt->execute(['name' => $name]);
    }
    public function gteCatIdWiseBlog($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE category_id = :category_id");
        $stmt->execute(['category_id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function catgetPaginatedPosts($limit, $offset, $category_id) {
        $stmt = $this->pdo->prepare("SELECT  posts.*,cg.name as catname FROM posts  left join categories cg on cg.id = posts.category_id  WHERE category_id = :category_id ORDER BY publish_date DESC LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get total count of blog posts
    public function catgetTotalPosts($category_id) {
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM posts where category_id = '$category_id' ");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
}
