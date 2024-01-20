<?php

require_once("../Service/bookService.php");
require_once("../Service/userService.php");
require_once("../api/bookControllerAPI.php");

class mainController {

public function about() {
    //require the view page
    require_once("../view/about.php");
}


}