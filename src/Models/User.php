<?php

namespace App\Models;

use PDO;

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    // Check if a user exists by email
    public function userExists($email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetchColumn() > 0;
    }
    // Example method to create a user
    public function create($fname,$email, $password) {
        $json = array();
        if ($this->userExists($email)) {
            $json = ["error"=>404,"message"=>"The email address '$email' is already registered."];
            return json_encode($json);
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("INSERT INTO users (email, password , fname) VALUES (:email, :password, :fname)");
        $stmt->execute(['email' => $email, 'password' => $hashedPassword, 'fname'=>$fname]);
        $json = ["error"=>200,"message"=>"User Registered Successfully. "];
        return json_encode($json);
    }
   
    // Authenticate a user by checking email and password
    public function authenticate($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $json = array();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            $json = ["error"=>200,"message"=>"Login Successfull.", "uid"=>$user['id']];
            return json_encode($json);
        }
        $json = ["error"=>204,"message"=>"Please Check your Credentials."];
        return json_encode($json);
    }
    // Fetch all users
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM users ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Deactivate a user
    public function deactivateUser($id) {
        $stmt = $this->pdo->prepare("UPDATE users SET is_active = 0 WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    // Delete a user
    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
