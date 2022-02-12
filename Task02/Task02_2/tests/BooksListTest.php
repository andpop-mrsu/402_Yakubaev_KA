<?php

namespace App\Tests;

use App\Book;
use App\BooksList;

use PHPUnit\Framework\TestCase;

class BooksListTest extends TestCase
{
    public function testAddAndCount()
    {
        $book = new Book();
        $booksList = new BooksList();
        $booksList->add($book);

        $this->assertEquals(1, $booksList->count());
    }

    public function testGet()
    {
        $book = new Book();
        $booksList = new BooksList();

        $book->
        setTitle("Design Patterns")->
        setAuthors(array("Freeman E.","Freeman E.","Sierra K.","Bates B."))->
        setPublishingHous("St. Petersburg: Peter")->
        setPublishingYear(2011);

        $booksList->add($book);
        $this->assertInstanceOf(Book::class, $booksList->get(1));
    }

    public function testStore()
    {
        $book = new Book();
        $booksList = new BooksList();

        setTitle("Design Patterns")->
        setAuthors(array("Freeman E.","Freeman E.","Sierra K.","Bates B."))->
        setPublishingHous("St. Petersburg: Peter")->
        setPublishingYear(2011);

        $booksList->add($book);
        $this->assertEquals(null, $booksList->store("storage"));
    }

    public function testLoad()
    {
        $booksList = new BooksList();

        $this->assertEquals("Файл успешно загружен", $booksList->load("storage"));
        $this->assertEquals(1, $booksList->count());
        $this->assertInstanceOf(Book::class, $booksList->get(1));
    }
}
