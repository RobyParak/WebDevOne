<?php

require_once("../Service/UserService.php");
require_once ("../Model/User.php");
class loginController
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function login()
    {
        require_once("../view/login.php");
    }


    public function validateLogin($user_name, $password)
    {
        var_dump($this->userService); // debug code
        $loggedIn = $this->userService->validateLogin($user_name, $password);
        if ($loggedIn) {
            $user = $this->userService->getUser($user_name);
            $_SESSION['user'] = $user;
            $_SESSION['name'] = $user->name;
            echo("Log in was successful, welcome " . $user->name);
            header("Location: userprofile");
        } else {
            echo "Invalid username or password";
        }
    }
}