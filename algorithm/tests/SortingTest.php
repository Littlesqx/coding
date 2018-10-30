<?php

namespace Algorithm\Tests;

use function Algorithm\array_same;
use function Algorithm\generate_random_int_array;
use PHPUnit\Framework\TestCase;

class SortingTest extends TestCase
{
    public function testInsertionSort()
    {
        $array = generate_random_int_array(20);
        $sorted = \Algorithm\Sorting\InsertionSort\sort($array);
        $expect = $array; sort($expect);
        $this->assertSame(array_same($sorted, $expect), true);
    }
}