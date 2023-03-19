<?php

require_once("../Service/UserService.php");

class userController
{
    private $service;
    public function __construct()
    {
        
    }

    public function user() {
        $this->service = new UserService();
        $user = ($_SESSION['user']);
        require_once("../view/userprofile.php");
    }

    public function updateUser($user)
    {
        $this->service->updateUser($user);
    }

    public function deleteUser($user)
    {
        $this->service->deleteUser($user);
    }
}