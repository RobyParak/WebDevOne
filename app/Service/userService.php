<?php
require_once"../repo/userRepo.php";
require_once"../Model/user.php";

class userService
{
    private userRepo $repository;

    public function __construct()
    {
        $this->repository = new userRepo();
    }

    public function getUser($user_name)
    {
        return $this->repository->getUser($user_name);
    }

    public function updateUser($user): void
    {
        $this->repository->updateUser($user);
    }

    public function validateLogin($user_name, $password)
    {
        $user = $this->getUser($user_name);
        if ($user != null) {
            return password_verify($password, $user->password);
        }
    }

    public function deleteUser($id): void
    {
        $this->repository->deleteUser($id);
    }

    public function register($name, $password, $email): int
    {
        $user = new user();
        $user->name = $name;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->email = $email;
        $user->balance = 0;
        return $this->repository->addUser($user);
    }
}
