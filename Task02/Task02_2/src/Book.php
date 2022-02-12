<?php

namespace App;

class Book
{
    private static $lastId = 1;
    private $id;
    private $title;
    private $authors = array();
    private $publishingHous;
    private $publishingYear;

    public function __construct()
    {
        $this->id = self::$lastId++;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setTitle($title) : Book
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setAuthors($authors) : Book
    {
        $this->authors = $authors;
        return $this;
    }

    public function getAuthors() : array
    {
        return $this->authors;
    }

    public function setPublishingHous($publishingHous) : Book
    {
        $this->publishingHous = $publishingHous;
        return $this;
    }

    public function getPublishingHous() : string
    {
        return $this->publishingHous;
    }    

    public function setPublishingYear($publishingYear) : Book
    {
        $this->publishingYear = $publishingYear;
        return $this;
    }
    public function getPublishingYear() : int
    {
        return $this->publishingYear;
    }

    public function __toString() : string
    {
        $outputString = "Id: " . $this->getId()."\n" . 
            "Название: " . $this->getTitle() . "\n";
        for($i = 0; $i < count($this->authors); $i++) {
            $outputString .= "Автор" . ($i + 1) . ": ";
            $outputString .= $this->getAuthors()[$i] . "\n";
        }    
        $outputString .= "Издательский дом: ";
        $outputString .= $this->getPublishingHous() . "\n";
        $outputString .= "Год издания: ";
        $outputString .= $this->getPublishingYear() . "\n";
        return $outputString;
    }
}
