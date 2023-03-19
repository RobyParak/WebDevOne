<?php
require_once("../repo/UserRepo.php");

class UserService
{
private $repository;
    public function __construct()
    {
        $this->repository = new UserRepo();
    }

    public function getUser($user_name)
    {
        $user = $this->repository->getUser($user_name);
        return $user;
    }
    
    // public function getAll()
    // {
    //     $users = $this->repository->getAll();
    //     return $users;
    // }

    public function updateUser($user)
    {
        $this->repository->updateUser($user);
    }

    public function validateLogin($user_name, $password) {
        $user = $this->getUser($user_name);
        if ($user != null) {
            return password_verify($password, $user->password);
        }
    }
    public function deleteUser($user)
    {
        $this->repository->deleteUser($user);
    }
}