<?php

namespace App;

class Controller
{
    protected function render($view, $data = [])
    {
        extract($data);

        include "Views/$view.php";
    }

    protected function Adminrender($view, $data = [])
    {
        extract($data);

        include "Views/adminPanle/$view.php";
    }
    // Generate CSRF Token
    protected function generateCsrfToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Secure random token
        }
        return $_SESSION['csrf_token'];
    }

    // Validate CSRF Token
    protected function validateCsrfToken($token) {
        if (empty($token) || $token !== $_SESSION['csrf_token']) {
            throw new \Exception("Invalid CSRF token.");
        }
    }

    // Regenerate Token After Validation (optional)
    protected function regenerateCsrfToken() {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}