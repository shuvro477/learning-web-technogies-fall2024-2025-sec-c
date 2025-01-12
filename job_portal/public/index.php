<?php
// Include necessary files
require_once '../config/database.php';

// Autoload controllers and models
spl_autoload_register(function ($class) {
    $paths = [
        '../app/controllers/' . $class . '.php',
        '../app/models/' . $class . '.php',
    ];
    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Parse the request to determine controller, action, and parameters
$controllerName = $_GET['controller'] ?? 'Admin'; // Default controller
$actionName = $_GET['action'] ?? 'index'; // Default action
$id = $_GET['id'] ?? null; // Optional ID

// Add "Controller" suffix to controller name
$controllerClass = $controllerName . 'Controller';

// Check if the controller exists
if (!class_exists($controllerClass)) {
    die("Controller $controllerClass not found.");
}

// Instantiate the controller
$controller = new $controllerClass();

// Call the action if it exists, otherwise show an error
if (method_exists($controller, $actionName)) {
    if ($id) {
        $controller->$actionName($id);
    } else {
        $controller->$actionName();
    }
} else {
    die("Action $actionName not found in controller $controllerClass.");
}
?>
