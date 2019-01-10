<?php

/*
 * This file is part of the coding.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Tests;


use DesignPattern\Behavioral\Iterator\Book;
use DesignPattern\Behavioral\Iterator\BookList;
use PHPUnit\Framework\TestCase;

class IteratorTest extends TestCase
{

    public function testCanAddBookToList()
    {
        $books = new BookList();
        $books->addBook(new Book('Book 1', 'Author 1'));
        $this->assertCount(1, $books);
    }

    public function testCanRemoveBookFromList()
    {
        $books = new BookList();
        $book = new Book('Book 1', 'Author 1');
        $books->addBook($book)->removeBook($book);

        $this->assertCount(0, $books);
    }

    public function testCanIterateOverBookList()
    {
        $books = new BookList();
        $books->addBook(new Book('Book 1', 'Author 1'))
            ->addBook(new Book('Book 2', 'Author 2'))
            ->addBook(new Book('Book 3', 'Author 2'));

        $bookTitles = [];
        foreach ($books as $book) {
            $bookTitles[] = $book->getTitle();
        }
        $this->assertEquals(['Book 1', 'Book 2', 'Book 3'], $bookTitles);
    }

    public function testCanIterateOverBookListAfterRemovingBook()
    {
        $book1 = new Book('Book 1', 'Author 1');
        $books = new BookList();
        $books->addBook($book1)
            ->addBook(new Book('Book 2', 'Author 2'))
            ->addBook(new Book('Book 3', 'Author 2'))
            ->removeBook($book1);

        $bookTitles = [];
        foreach ($books as $book) {
            $bookTitles[] = $book->getTitle();
        }
        $this->assertEquals(['Book 2', 'Book 3'], $bookTitles);
    }


}