<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['user'] = null;

$page = $_SERVER['REQUEST_URI'];

//calling the class including the file/folders you need to use
require_once("../Controllers/MainController.php");
$controller = new MainController();

switch($page) {
    case"/":
    case "/home/index":
    case '/view/about':
    case"/about":
        $controller->about();
        break;
    case '/view/login':
    case"/login":
        require_once("../Controllers/loginController.php");
        $controller= new loginController();
        $controller->login();
        break;
    case '/view/userprofile':
    case"/userprofile":
        require_once("../Controllers/userController.php");
        $controller = new userController();
        $controller->user();
        break;
    case '/view/catalogue':
    case"/catalogue":
        require_once("../api/BookController.php");
        $controller = new BookController();
        $controller->catalogue();
        break;
    default:
        // Handle 404 error
        http_response_code(404);
        echo "404 Not Found";
        break;
}
