<?php

require_once ("../model/Book.php");
require_once __DIR__ . '/baseRepo.php';
use repository\baseRepo;
class BookRepo extends baseRepo
{

    public function getAll()
    {

        $stmt = $this->connection->prepare("SELECT id, title, author, description, availability FROM book");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Book');
        $books = $stmt->fetchAll();
        return $books;

    }

    public function GetAvailableBooks()
    {
        $stmt = $this->connection->prepare("SELECT id, title, description, author, availability FROM books WHERE availability = 1");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Book');
        $books = $stmt->fetchAll();
        return $books;
    }

//below method updates the book in the database
    public function UpdateBook($book)
    {
        $stmt = $this->connection->prepare("UPDATE book SET title = :book.title, author = :book.author, description = :book.description, 
availability = :book.availability, lendingDate = :book.lendingDate, returnDate= :book.returnDate WHERE id = :book.id");
        $stmt->bindValue(':book.title', $book->title);
        $stmt->bindValue(':book.author', $book->author);
        $stmt->bindValue(':book.description', $book->description);
        $stmt->bindValue(':book.availability', $book->availability);
        $stmt->bindValue(':book.lendingDate', $book->lendingDate);
        $stmt->bindValue(':book.returnDate', $book->returnDate);
        $stmt->bindValue(':book.id', $book->id);
        $stmt->execute();
    }

    public function getBookByID($id)
    {
        $stmt = $this->connection->prepare("SELECT id, title, author, description, availability FROM book WHERE id = :book_id");
        $stmt->bindValue(":book_id", $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Book');
        $book = $stmt->fetch();
        return $book;
    }

    public function getBookByUser($user)
    {
        $stmt = $this->connection->prepare("SELECT book.title, book.author, book.lendingDate, book.returnDate
    FROM book
    JOIN book_user ON book.id = book_user.book_id
    JOIN user ON book_user.user_id = user.id
    WHERE user.id = :user_ID LIMIT 1");
        $stmt->bindValue(":user_ID", $user->id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Book');
        $book = $stmt->fetch();
        return $book;
    }

    public function addBookUser($book_id, $user_id)
    {
        $stmt = $this->connection->prepare("INSERT INTO book_user (book_id, user_id) VALUES (:book_Id, :user_Id)");
        $stmt->bindValue(":book_ID", $book_id);
        $stmt->bindValue(":user_ID", $user_id);
        $stmt->execute();
    }
}