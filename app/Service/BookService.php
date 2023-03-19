<?php

require_once("../repo/BookRepo.php");
class BookService 
{
  private $repository;
    public function __construct()
    {
        $this->repository = new BookRepo();
    }

    public function getAll()
    {
        $books = $this->repository->getAll();
        // Convert the data to a JSON string
        $json = json_encode($books);
        return $json;
    }
    private function updateBook($book)
    {
        $this->repository->updateBook($book);
    }
    public function getBookByUser($user)
    {
        $book = $this->repository->getBookByUser($user);
        return $book;
    }
    private function addBookUser($book_id, $user_id)
    {
        $this->repository->addBookUser($book_id, $user_id);
    }
    public function lendBook($book_id, $user_id)
    {
        //check if the book exists, then if it's available
        $book = $this->repository->getBookById($book_id);
        if ($book == null) {
            echo "Book not found";
            return;
        }
        if ($book->availability == 0) {
            echo "Book is not available";
            return;
        }
        $returnDate= $this->calculateReturnDate();
        $book=$this->setDatesAndAvailability($book, $returnDate);
      
        //write the book-user relation in the database
        $this->addBookUser($book_id, $user_id);
        //update the book in the database
        $this->updateBook($book);

    }
    private function calculateReturnDate()
    {
        $returnDate = time();
        $returnDate = strtotime("+3 week", $returnDate);
        return $returnDate;
    }
    private function setDatesAndAvailability($book, $returnDate)
    {
    //set the availability to 0, set the lending date to today, set the return date
    $book->lendingDate = time();
    $book->returnDate=$returnDate;
    $book->availability=0;
    return $book;
    }
}