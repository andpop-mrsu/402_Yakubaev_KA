<?php

namespace App;

use App\Book;
use Iterator as Iterator;
use App\Logger;
use App\FileLogger;
use App\DBLogger;

class BooksList implements Iterator
{
    private array $books;
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
        $this->logger->log(date("d.m.Y"), date("H:i:s"), "Cоздан список книг");
    }

    public function add(Book $book): void
    {
        $this->books[] = $book;
        $this->logger->log(date("d.m.Y"), date("H:i:s"), "В список добавлена книга");
    }

    public function count(): int
    {
        return count($this->books);
    }

    public function get(int $n): Book
    {
        return $this->books[$n - 1];
    }

    public function store(string $fileName): void
    {
        file_put_contents($fileName, serialize($this->books));
    }

    public function load(string $fileName): string
    {
        if (!file_exists($fileName)) {
            return "Файл не найден";
        }

        $this->books = unserialize(file_get_contents($fileName));

        return "Файл успешно загружен";
    }

    public function current(): mixed
    {
        $result = current($this->books);

        return $result;
    }

    public function key(): int
    {
        $result = current($this->books)->getId();

        return $result;
    }

    public function next(): void
    {
        $result = next($this->books);

        echo "\n" . "next: $result" . PHP_EOL;
    }

    public function rewind(): void
    {
        reset($this->books);
    }

    public function valid(): bool
    {
        $result = $this->current() !== false;

        return $result;
    }
}
