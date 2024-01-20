<?php
require_once "../Service/userService.php";

class userControllerAPI
{
    private userService $service;

    public function __construct()
    {
        $this->service = new userService();
    }

    public function register(): void
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $body = file_get_contents('php://input');
            $obj = json_decode($body);
            $userId = $this->service->register($obj->name, $obj->password, $obj->email);

            if ($userId > 0) {
                http_response_code(201);
                echo json_encode(array("message" => "User was created.", "id" => $userId));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Unable to create user."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
        }
    }

    public function deleteUser(): void
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: DELETE");

        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $body = file_get_contents('php://input');
            $obj = json_decode($body);
            $this->service->deleteUser($obj->id);
            http_response_code(200);
            echo json_encode(array("message" => "User was deleted."));
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to delete user. Data is incomplete."));
        }
    }
}
