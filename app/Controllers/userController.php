<?php
session_start();
require_once"../Service/userService.php";
require_once"../Model/user.php";

class userController
{
    private userService $service;
    public function __construct()
    {
        $this->service = new userService();
    }
    public function updateUser($user)
    {
        $this->service->updateUser($user);
    }

    public function deleteUser(): void
    {
        $this->service->deleteUser($_SESSION['user']);
    }

    public function user(): void
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
        }
        $user = unserialize($_SESSION['user']);
        require_once"../view/userprofile.php";
    }
}