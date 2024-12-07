<?php

namespace App;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';   // Database host
    private $dbName = 'blogpost';  // Database name
    private $username = 'root';    // Database username
    private $password = '';        // Database password (empty for local MySQL default)
    private $pdo;

    public function __construct() {
        try {
            // Create PDO instance
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username, $this->password);
            
            // Set PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // If connection fails, show error message
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Get PDO instance
    public function getConnection() {
        return $this->pdo;
    }
}
