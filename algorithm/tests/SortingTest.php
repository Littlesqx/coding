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

        $array = generate_random_int_array(20);
        $sorted = \Algorithm\Sorting\InsertionSort\sort2($array);
        $expect = $array; sort($expect);
        $this->assertSame(array_same($sorted, $expect), true);
    }

    public function testBubbleSort()
    {
        $array = generate_random_int_array(20);
        $sorted = \Algorithm\Sorting\BubbleSort\sort($array);
        $expect = $array; sort($expect);
        $this->assertSame(array_same($sorted, $expect), true);
    }

    public function testSelectionSort()
    {
        $array = generate_random_int_array(20);
        $sorted = \Algorithm\Sorting\SelectionSort\sort($array);
        $expect = $array; sort($expect);
        $this->assertSame(array_same($sorted, $expect), true);
    }

    public function testMergeSort()
    {
        $array = generate_random_int_array(20);
        $sorted = \Algorithm\Sorting\MergeSort($array);
        $expect = $array; sort($expect);
        $this->assertSame(array_same($sorted, $expect), true);
    }

}
