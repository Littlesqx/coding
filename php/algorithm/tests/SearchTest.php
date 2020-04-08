<?php

namespace Algorithm\Tests;

use function Algorithm\Search\binarySearch;
use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    public function testBinarySearch()
    {
        $sortedArray = [1, 2, 3, 4, 7, 7, 7, 8, 9];

        $this->assertSame(4, binarySearch($sortedArray, 7));
        $this->assertSame(8, binarySearch($sortedArray, 9));
        $this->assertSame(-1, binarySearch($sortedArray, 70));
    }
}