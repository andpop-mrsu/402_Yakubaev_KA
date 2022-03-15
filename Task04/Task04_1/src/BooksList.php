<?php

namespace App;

use App\Book;
use Iterator as Iterator;

class BooksList implements Iterator
{
    private array $books;

    public function add(Book $book): void
    {
        $this->books[] = $book;
    }

    public function count(): int
    {
        return count($this->books);
    }

    public function get(int $n): Book
    {
        return $this->books[$n - 1];
    }

    public function store(string $fileName)
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

    public function current(): Book
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
