<?php

class Book{
    public int $id;
    public string $title;
    public string $description;
    public string $author;
    public string $genre;
    public date $lendingDate;
    public date $returnDate;
    public bool $availability;
}