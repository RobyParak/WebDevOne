<?php

require_once("../repo/bookRepo.php");
class bookService
{
  private bookRepo $repository;
    public function __construct()
    {
        $this->repository = new bookRepo();
    }

    private function updateBook($book): void
    {
        $this->repository->updateBook($book);
    }
    public function addBookUser($book_id, $user_id): bool|string
    {
        $this->repository->addBookUser($book_id, $user_id);
        return $this->repository->getLastInsertID();

    }
    public function lendBook($book_id, $user_id): void
    {
        $book = $this->repository->getBookByID($book_id);
        if ($book->availability == 1) {
            // Book is available, update book properties
            $book->availability = 0; // set availability to not available
            $book->lendingDate = new DateTime();
            $book->returnDate = (new DateTime())->add(new DateInterval('21'));
            //write the book-user relation in the database
            $this->addBookUser($book_id, $user_id);
            //update the book in the database to not available
            $this->updateBook($book);
        }
        else {
            echo "Book is not available";
        }
    }
    public function getAllBooks(): bool|array
    {
        return $this->repository->getAll();
    }
}
