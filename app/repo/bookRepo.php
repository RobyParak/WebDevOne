<?php

require_once("../model/book.php");
require_once __DIR__ . '/baseRepo.php';
use repository\baseRepo;
class bookRepo extends baseRepo
{

    public function getAll()
    {

        $stmt = $this->connection->prepare("SELECT id, title, author, description, availability FROM book");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'book');
        $books = $stmt->fetchAll();
        return $books;

    }

//below method updates the book in the database
    public function UpdateBook($book)
    {
        $stmt = $this->connection->prepare("UPDATE book SET title = :title, author = :author, description = :description, availability = :availability, lendingDate = :lendingDate, returnDate= :returnDate WHERE id = :id");
        $stmt->bindValue(':title', $book->title);
        $stmt->bindValue(':author', $book->author);
        $stmt->bindValue(':description', $book->description);
        $stmt->bindValue(':availability', $book->availability);
        $stmt->bindValue(':lendingDate', $book->lendingDate->format('Y-m-d H:i:s'));
        $stmt->bindValue(':returnDate', $book->returnDate->format('Y-m-d H:i:s'));
        $stmt->bindValue(':id', $book->id);
        $stmt->execute();
    }
    public function getBookByID($id)
    {

        $stmt = $this->connection->prepare("SELECT * FROM book WHERE id = :book_id");
        $stmt->bindValue(":book_id", $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'book');
        $book = $stmt->fetch();
        return $book;
    }
    public function addBookUser($book_id, $user_id)
    {
        $stmt = $this->connection->prepare("INSERT INTO book_user (book_id, user_id) VALUES (:book_id, :user_id)");
        $stmt->bindValue(":book_id", $book_id);
        $stmt->bindValue(":user_id", $user_id);
        $stmt->execute();
    }

    public function getLastInsertID(): bool|string
    {
        return $this->connection->lastInsertId();
    }
}