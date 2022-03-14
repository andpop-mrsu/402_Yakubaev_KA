<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\BooksList;
use App\Book;
use App\FileLogger;
use App\DBLogger;

class LoggerTest extends TestCase
{
    public function testLog()
    {
        $fileName = "textLog";
        $dbName = "dbLog";
        $fileLogger = new FileLogger($fileName);
        $booksList1 = new BooksList($fileLogger);
        $this -> assertTrue(file_exists("./logs/" . $fileName . ".txt"));
        $sizeLogsTxt = sizeof(file("./logs/" . $fileName . ".txt"));
        $book1 = new Book();
        $book2 = new Book();
        $booksList1->add($book1);
        $booksList1->add($book2);
        $this->assertSame($sizeLogsTxt + $booksList1->count(), sizeof(file("./logs/" . $fileName . ".txt")));
        $dbLogger = new DbLogger($dbName);
        $booksList2 = new BooksList($dbLogger);
        $this -> assertTrue(file_exists("./logs/" . $dbName . ".db"));
        $booksList2->add($book1);
        $booksList2->add($book2);
    }
}
