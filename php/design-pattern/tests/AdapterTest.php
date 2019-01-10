<?php

namespace DesignPattern\Tests;

use DesignPattern\Structural\Adapter\Book;
use DesignPattern\Structural\Adapter\EBookAdapter;
use DesignPattern\Structural\Adapter\Kindle;
use PHPUnit\Framework\TestCase;

class AdapterTest extends TestCase
{
    public function testTurnPageOnBook()
    {
        $book = new Book();
        $book->open();
        $book->turnPage();

        $this->assertEquals(2, $book->getPage());
    }

    public function testTurnPageOnKindleLikeBook()
    {
        $kindle = new Kindle();
        $book = new EBookAdapter($kindle);

        $book->open();
        $book->turnPage();

        $this->assertEquals(2, $book->getPage());
    }
}