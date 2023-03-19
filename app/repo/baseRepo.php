<?php

namespace repository;
use PDO;
use PDOException;

class baseRepo
{
    protected $connection;

    public function __construct()
    {
        try {
            require_once __DIR__ . '/config.php';
            $this->connection = new PDO("mysql:host=$servername; dbname=$db_name", $db_username, $db_password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
}