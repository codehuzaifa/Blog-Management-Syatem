<?php

namespace App\Models;

use PDO;

class Blog {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    // Get all blog posts
    public function getAllPosts($limit = 10) {
        $stmt = $this->pdo->prepare("SELECT posts.*,cg.name as catname FROM posts  left join categories cg on cg.id = posts.category_id ORDER BY publish_date DESC LIMIT :limit");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a single blog post by ID
    public function getPostById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create a new blog post
    public function createPost($title, $description, $image, $authername, $category_id) {
        // Prepare the SQL statement with placeholders
        $stmt = $this->pdo->prepare("INSERT INTO posts (title, description, image, publish_date, authername,category_id) 
                                     VALUES (:title, :description, :image, NOW(), :authername, :category_id)");
    
        // Bind the user inputs to the placeholders
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':authername', $authername, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_STR);
    
        // Execute the query
        $stmt->execute();
    }

    // Update an existing blog post
    public function updatePost($id, $title, $description, $image, $authername, $category_id) {
        // Validate the image if provided
        if ($image) {
            $imageValidation = $this->validateImage($image);
            if ($imageValidation !== true) {
                throw new \Exception($imageValidation);  // If validation fails, throw an exception
            }
    
            // Handle the image upload
            $imageName = $this->uploadImage($image);
        }
    
        // Use prepared statement to prevent SQL injection
        $stmt = $this->pdo->prepare(
            "UPDATE posts SET title = :title, description = :description, image = :image, authername = :authername, category_id = :category_id WHERE id = :id"
        );
    
        // Bind parameters securely
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':image', $imageName, PDO::PARAM_STR);  // Use the image name from the upload
        $stmt->bindParam(':authername', $authername, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);  // Bind the id as an integer
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);  // Bind the id as an integer
    
        // Execute the query
        $stmt->execute();
    }
    
    private function uploadImage($image) {
        $targetDir = __DIR__ ."/../../public/uploads/";
        $imageName = time() . "_" . basename($image['name']);
        $targetFilePath = $targetDir . $imageName;

        if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
            return $imageName;  // Return the new image name
        }

        throw new \Exception('Failed to upload image.');  // Handle upload failure
    }

    // Delete a blog post by ID
    public function deletePost($id) {
        $stmt = $this->pdo->prepare("DELETE FROM posts WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
    // Fetch paginated blog posts
    public function getPaginatedPosts($limit, $offset) {
        $stmt = $this->pdo->prepare("SELECT  posts.*,cg.name as catname FROM posts  left join categories cg on cg.id = posts.category_id ORDER BY publish_date DESC LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get total count of blog posts
    public function getTotalPosts() {
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM posts");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    // Helper method to validate image type and size
    private function validateImage($image) {
        // Allowed file types (JPEG, PNG, GIF)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        // Check the file type
        if (!in_array($image['type'], $allowedTypes)) {
            return 'Invalid image type. Only JPG, PNG, and GIF are allowed.';
        }

        // Check the file size (limit to 5MB for this example)
        $maxSize = 5 * 1024 * 1024;  // 5MB
        if ($image['size'] > $maxSize) {
            return 'The image size exceeds the maximum allowed size of 5MB.';
        }

        return true;  // Image is valid
    }
    public function searchPosts($query)
    {
        // Use LIKE operator with % wildcard for partial matching
        $stmt = $this->pdo->prepare(
            "SELECT * FROM posts 
            WHERE title LIKE :query 
            OR description LIKE :query 
            OR authername LIKE :query"
        );
        
        // Bind the query with the % wildcard on both sides
        $stmt->bindValue(':query', '%' . $query . '%');
        $stmt->execute();
        
        // Return all matching results
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
   
}