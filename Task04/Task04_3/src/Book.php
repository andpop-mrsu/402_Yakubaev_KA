<?php

namespace App;

class Book
{
    private static int $lastId = 1;
    private int $id;
    private string $title;
    private array $authors;
    private string $publishingHous;
    private int $publishingYear;

    public function __construct()
    {
        $this->id = self::$lastId++;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setTitle(string $title): Book
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setAuthors(array $authors): Book
    {
        $this->authors = $authors;

        return $this;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }

    public function setPublishingHous(string $publishingHous): Book
    {
        $this->publishingHous = $publishingHous;

        return $this;
    }

    public function getPublishingHous(): string
    {
        return $this->publishingHous;
    }

    public function setPublishingYear(int $publishingYear): Book
    {
        $this->publishingYear = $publishingYear;

        return $this;
    }

    public function getPublishingYear(): int
    {
        return $this->publishingYear;
    }

    public function __toString(): string
    {
        $outputString = "Id: " . $this->getId() . "\n" .
            "Название: " . $this->getTitle() . "\n";

        for ($i = 0; $i < count($this->authors); $i++) {
            $outputString .= "Автор " . ($i + 1) . ": ";
            $outputString .= $this->getAuthors()[$i] . "\n";
        }

        $outputString .= "Издательский дом: ";
        $outputString .= $this->getPublishingHous() . "\n";
        $outputString .= "Год издания: ";
        $outputString .= $this->getPublishingYear();

        return $outputString;
    }
}
