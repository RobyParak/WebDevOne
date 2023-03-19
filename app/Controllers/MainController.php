<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['user'] = null;

require_once("../Service/BookService.php");
require_once("../Service/UserService.php");
require_once("../api/BookController.php");

class MainController {

public function about() {
    //require the view page
    require_once("../view/about.php");
}


}