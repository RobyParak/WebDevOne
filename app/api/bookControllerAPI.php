<?php

require_once("../Service/bookService.php");

class bookControllerAPI
{
    private bookService $service;

    public function __construct()
    {
        $this->service = new bookService();
    }

    public function catalogue(): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');

        // Respond to a GET request to /api/books
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $books = $this->service->getAllBooks();
            header('Content-Type: application/json');
            echo json_encode($books);
        }
    }

    public function addBookReservation(): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');

        // Respond to a POST request to /api/book-reservation
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"));

            if (isset($data['userId']) && isset($data['bookId'])) {
                $userId = $data['userId'];
                $bookId = $data['bookId'];

                $reservationId = $this->service->addBookUser($userId, $bookId);

                if ($reservationId) {
                    header('Content-Type: application/json');
                    echo json_encode($reservationId);
                } else {
                    http_response_code(500);
                    echo json_encode(array("message" => "Failed to add reservation."));
                }
            } else {
                http_response_code(400);
                echo json_encode(array("message" => "Missing required parameters."));
            }
        }
    }
}
