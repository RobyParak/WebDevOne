<?php
use repository\baseRepo;

require_once "../Model/user.php";
require_once __DIR__ . '/baseRepo.php';
require_once __DIR__ . '/bookRepo.php';

class userRepo extends baseRepo
{

    public function getUser($user_name)
    {
        //username is the email address so check against the email not the name
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE email = :user_name");
        $stmt->bindValue(":user_name", $user_name);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'user');
        $user = $stmt->fetch();
        $user->borrowed_books = $this->getBooksByUser($user);
        return $user;
    }

    public function updateUser($user): void
    {
        $stmt = $this->connection->prepare("UPDATE user SET name = :name, email = :email, password = :password, balance = :balance WHERE id = :id");
        $stmt->bindValue(':name', $user->name);
        $stmt->bindValue(':email', $user->email);
        $stmt->bindValue(':password', $user->password);
        $stmt->bindValue(':balance', $user->balance);
        $stmt->bindValue(':id', $user->id);
        $stmt->execute();
    }

    public function deleteUser($id): void
    {
        $stmt = $this->connection->prepare("DELETE FROM user WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function getBooksByUser($user): array
    {
        $stmt = $this->connection->prepare("SELECT book_id FROM book_user WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $user->id);
        $stmt->execute();
        $bookIds = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $books = [];
        foreach ($bookIds as $bookId) {
            $bookRepository = new bookRepo();
            $book = $bookRepository->getBookByID($bookId);
            $books[] = $book;
        }
        return $books;
    }

    public function addUser(user $user): int
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO user (name, email, password, balance) VALUES (:name, :email, :password, :balance)");
            $stmt->bindValue(':name', $user->name);
            $stmt->bindValue(':email', $user->email);
            $stmt->bindValue(':password', $user->password);
            $stmt->bindValue(':balance', $user->balance);
            $stmt->execute();

            error_log('User added successfully.');

            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            error_log('Error adding user: ' . $e->getMessage());
        }
        return -1;
    }

}
