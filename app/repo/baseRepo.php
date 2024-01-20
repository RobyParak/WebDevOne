<?php

namespace repository;
use PDO;
use PDOException;

class baseRepo
{
    protected PDO $connection;

    public function __construct()
    {
        try {
            require __DIR__ . '/config.php';
            $this->connection = new PDO("mysql:host=$servername; dbname=$db_name", $db_username, $db_password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
}