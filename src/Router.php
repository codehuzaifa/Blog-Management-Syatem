<?php

namespace App;

use App\Database;  // Import the Database class
// Set constants (root server path + root URL)
define('PROT', (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? 'https://' : 'http://');
define('ROOT_URL', PROT . $_SERVER['HTTP_HOST'] . str_replace('\\', '', dirname(htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES))) . '/'); // Remove backslashes for Windows compatibility
define('ROOT_PATH', __DIR__ . '/');
class Router {
    private $routes = [];

    // Add GET routes
    public function get($uri, $controller, $method) {
        $this->routes['GET'][$uri] = ['controller' => $controller, 'method' => $method];
    }
    
    // Add POST routes
    public function post($uri, $controller, $method) {
        $this->routes['POST'][$uri] = ['controller' => $controller, 'method' => $method];
    }

    // Render the view
    private function renderView($view, $data = []) {
        extract($data);
        $viewPath = __DIR__ . "/Views/$view.php";  // Ensure correct path for views
        if (file_exists($viewPath)) {
            include($viewPath);
        } else {
            echo "View not found: $viewPath";
        }
    }

    // Dispatch the request
    public function dispatch() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = str_replace('/Blog-Management-Syatem', '', $uri); // Remove base path
        $method = $_SERVER['REQUEST_METHOD'];

         // Create the PDO instance (from the Database class)
         $database = new Database();  // Instantiating the Database class
         $pdo = $database->getConnection();  // Getting the PDO connection

        // Check if the route exists
        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];
            $controller = $route['controller'];
            $action = $route['method'];

            // Check if the controller exists
            if (!class_exists($controller)) {
                $data = [
                    'code' => '404',
                    'title' => 'Controller Not Found',
                    'message' => "Controller not found: $controller"
                ];
                $this->renderView('404', $data);
                exit;
            }

            // If the controller requires parameters (like PDO), instantiate with them
            $controllerInstance = new $controller($pdo); // Pass $pdo if needed in controller

            // Check if the method exists in the controller
            if (!method_exists($controllerInstance, $action)) {
                $data = [
                    'code' => '404',
                    'title' => 'Method Not Found',
                    'message' => "Method not found: $action in $controller"
                ];
                $this->renderView('404', $data);
                exit;
            }

            // Call the controller method
            $controllerInstance->{$action}();
        } else {
            // Route not found
            $data = [
                'code' => '404',
                'title' => 'Page Not Found',
                'message' => 'The page you are looking for does not exist.'
            ];
            $this->renderView('404', $data);
        }
    }
}
