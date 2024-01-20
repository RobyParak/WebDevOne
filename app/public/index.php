<?php

$page = $_SERVER['REQUEST_URI'];

switch ($page) {
    case"/":
    case "/home/index":
    case '/view/about':
    case"/about":
    case "/home":
        require_once "../Controllers/mainController.php";
        $controller = new mainController();
        $controller->about();
        break;
    case '/view/login':
    case"/login":
        require_once "../Controllers/loginController.php";
        $controller = new loginController();
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $user_name = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars($_POST['password']);
            $controller->validateLogin($user_name, $password);
        } else {
            $controller->login();
        }
        break;
    case '/view/userprofile':
    case"/userprofile":
        require_once "../Controllers/userController.php";
        $controller = new userController();
        $controller->user();
        break;
    case '/api/books':
        require_once "../api/bookControllerAPI.php";
        $controller = new bookControllerAPI();
        $controller->catalogue();
        break;
    case '/view/catalogue':
    case"/catalogue":
        require_once '../view/catalogue.php';
        break;
    case "reserve":
    case '/reserve':
        require_once "../api/bookControllerAPI.php";
        $controller = new bookControllerAPI();
        $controller->addBookReservation();
        break;
    case "/deleteUser":
        require_once "../Controllers/userController.php";
        $controller = new userController();
        $controller->deleteUser();
        break;
    case '/register':
        require_once '../view/register.php';
        break;
    case '/api/register':
        require_once "../api/userControllerAPI.php";
        $controller = new userControllerAPI();
        $controller->register();
        break;
    case '/api/deleteUser':
        require_once "../api/userControllerAPI.php";
        $controller = new userControllerAPI();
        $controller->deleteUser();
        break;
    default:
        // Handle 404 error
        http_response_code(404);
        echo "404 Not Found";
        break;
}
