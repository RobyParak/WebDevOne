<?php
ob_start(); 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['user'] = null;

require_once("../Service/BookService.php");
require_once("../Controllers/MainController.php");

class BookController extends MainController
{
    private $service;

    public function __construct()
    {
        $this->service = new BookService();
        require_once("../view/catalogue.php");
        $this->catalogue();
    }

    public function catalogue()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Methods: *");

        if (!isset($_SERVER['HTTP_AUTHORIZATION']) || strlen(trim($_SERVER['HTTP_AUTHORIZATION'])) == 0) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            try {
                $books = $this->service->getAll();
                header('Content-Type: application/json');
                echo json_encode($books);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Server error']);
            }
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $bookId = $requestData['bookId'];
            $user = $requestData['user'];
            if (empty($bookId) || empty($user)) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid input']);
                exit();
            }
            try {
                //below method makes more sense if you read what it does in the service
                //I tried to gibve it a meaningful name
                $this->service->lendBook($bookId, $user);
                http_response_code(200);
                echo json_encode(['message' => 'Book reserved successfully']);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Invalid request method']);
        }
    }
}