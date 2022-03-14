<?php

namespace App\Tests;

use App\Book;
use App\BooksList;
use PHPUnit\Framework\TestCase;

class BooksListTest extends TestCase
{
    public function testCurrentAndKey()
    {
        $book1 = new Book();
        $book2 = new Book();
        $book3 = new Book();
        $booksList = new BooksList();

        $book1->setTitle("Design Patterns")
            ->setAuthors(array("Freeman E.","Freeman E.","Sierra K.","Bates B."))
            ->setPublishingHous("St. Petersburg: Peter")
            ->setPublishingYear(2011);

        $book2->setTitle("Clean Code")
            ->setAuthors(array("Robert C. Martin"))
            ->setPublishingHous("Prentice Hall")
            ->setPublishingYear(2012);

        $book3->setTitle("Introduction to Algorithms")
            ->setAuthors(array("Thomas H. Cormen", "Charles E. Leiserson", "Ronald L. Rivest", "Clifford Stein"))
            ->setPublishingHous("The MIT Press")
            ->setPublishingYear(2013);

        $booksList->add($book1);
        $booksList->add($book2);
        $booksList->add($book3);

        $this->assertSame(
            "Id: 5" . "\n" .
            "Название: Design Patterns" . "\n" .
            "Автор 1: Freeman E." . "\n" .
            "Автор 2: Freeman E." . "\n" .
            "Автор 3: Sierra K." . "\n" .
            "Автор 4: Bates B." . "\n" .
            "Издательский дом: St. Petersburg: Peter" . "\n" .
            "Год издания: 2011",
            $booksList->current()->__toString()
        );
        $this->assertSame(5, $booksList->key());
        $booksList->store("storage");
        return $booksList;
    }

    public function testNext()
    {
        $booksList = new BooksList();
        $booksList->load("storage");
        $booksList->next();
        $this->assertSame(
            "Id: 6" . "\n" .
            "Название: Clean Code" . "\n" .
            "Автор 1: Robert C. Martin" . "\n" .
            "Издательский дом: Prentice Hall" . "\n" .
            "Год издания: 2012",
            $booksList->current()->__toString()
        );
        $booksList->next();
        $this->assertSame(
            "Id: 7" . "\n" .
            "Название: Introduction to Algorithms" . "\n" .
            "Автор 1: Thomas H. Cormen" . "\n" .
            "Автор 2: Charles E. Leiserson" . "\n" .
            "Автор 3: Ronald L. Rivest" . "\n" .
            "Автор 4: Clifford Stein" . "\n" .
            "Издательский дом: The MIT Press" . "\n" .
            "Год издания: 2013",
            $booksList->current()->__toString()
        );

        return $booksList;
    }

    public function testValidAndRewind()
    {
        $booksList = new BooksList();
        $booksList->load("storage");
        $booksList->next();
        $this->assertSame(true, $booksList->valid());
        $booksList->rewind();
        $this->assertSame(true, $booksList->valid());
        $this->assertSame(
            "Id: 5" . "\n" .
            "Название: Design Patterns" . "\n" .
            "Автор 1: Freeman E." . "\n" .
            "Автор 2: Freeman E." . "\n" .
            "Автор 3: Sierra K." . "\n" .
            "Автор 4: Bates B." . "\n" .
            "Издательский дом: St. Petersburg: Peter" . "\n" .
            "Год издания: 2011",
            $booksList->current()->__toString()
        );
    }
}
