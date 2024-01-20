<?php
require_once("../Service/bookService.php");
require_once("../Model/user.php");
session_start();
class bookController
{
    private bookService $bookService;

    public function __construct()
    {
        $this->bookService = new bookService();
    }

    public function reserveBook(): void
    {
        // Check if user is logged in
        if (isset($_SESSION['user'])) {
            $userSerialized = $_SESSION['user'];
            $user = unserialize($userSerialized);
            $user_id = $user->id;
            if (isset($_POST['id'])) {
                $book_id = intval($_POST['id']);
                $this->bookService->lendBook($book_id, $user_id);
            } else {
                echo "Invalid book ID";
            }
        } else {
            echo "Not logged in";
        }
    }

}
