<?php
//link it to the model user
use repository\baseRepo;

require_once("../Model/User.php");
require_once __DIR__ . '/baseRepo.php';
class UserRepo extends baseRepo
{

public function getUser($user_name){
    //username is the email address so check against the email not the name
    $stmt = $this->connection->prepare("SELECT id, [name], email, [password], balance FROM user WHERE email = [:user_name]");
    $stmt->bindValue(":user_name", $user_name);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $user = $stmt->fetch();
    //$user->borrowed_books = $this->getBorrowedBooks($user);
    return $user;
}
private function getBorrowedBooks($user)
{

    $stmt = $this->connection->prepare("SELECT book.title, book.author, book.lendingDate, book.returnDate
    FROM book
    JOIN book_user ON book.id = book_user.book_id
    JOIN user ON book_user.user_id = user.id
    WHERE user.id = :user_ID LIMIT 1");
    $stmt->bindValue(":user_ID", $user->id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Book');
    $books = $stmt->fetch();
    return $books;
}

public function getAll()
{
    $stmt = $this->connection->prepare("SELECT id, [name], email, [password], balance FROM user");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $users=$stmt->fetchAll();
    return $users;

}

public function updateUser($user)
{
    $stmt = $this->connection->prepare("UPDATE user SET name = :name, email = :email, password = :password, balance = :balance WHERE id = :id");
    $stmt->bindValue(':name', $user->name);
    $stmt->bindValue(':email', $user->email);
    $stmt->bindValue(':password', $user->password);
    $stmt->bindValue(':balance', $user->balance);
    $stmt->bindValue(':id', $user->id);
    $stmt->execute();
}
public function deleteUser($user)
{
    $stmt = $this->connection->prepare("DELETE FROM user WHERE id = :id");
    $stmt->bindValue(':id', $user->id);
    $stmt->execute();
}
}