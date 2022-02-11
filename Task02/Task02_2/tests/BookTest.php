<?php
namespace Tests\BookTest;

use App\Book;

use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    public function testSetTitleAndGetTitle()
    {
        $book = new Book();
        $book->setTitle("Design Patterns");
        $this->assertEquals("Design Patterns", $book->getTitle());
    }

    public function testSetAuthorsAndGetAuthors()
    {
        $book = new Book();
        $book->setAuthors(array(
            "Freeman E.",
            "Freeman E.",
            "Sierra K.",
            "Bates B."
        ));
        $this->assertEquals(array(
            "Freeman E.",
            "Freeman E.",
            "Sierra K.",
            "Bates B."
        ), $book->getAuthors());
    }

    public function testSetPublishingHousAndGetPublishingHous()
    {
        $book = new Book();
        $book->setPublishingHous("St. Petersburg: Peter");
        $this->assertEquals(
            "St. Petersburg: Peter", 
            $book->getPublishingHous()
        );
    }

    public function testSetPublishingYearAndGetPublishingYear()
    {
        $book = new Book();
        $book->setPublishingYear(2011);
        $this->assertEquals(2011, $book->getPublishingYear());
    }
}