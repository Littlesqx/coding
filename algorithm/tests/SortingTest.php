<?php

namespace Algorithm\Tests;

use function Algorithm\isSorted;
use function Algorithm\randomIntArray;
use PHPUnit\Framework\TestCase;

class SortingTest extends TestCase
{

    /**
     * sortTest data provider.
     *
     * @return array
     */
    public function getRandomArray() : array
    {
        return [
            [randomIntArray(30)],
        ];
    }

    /**
     * @param array $array
     *
     * @dataProvider getRandomArray
     */
    public function testInsertionSort(array $array)
    {
        $sorted = \Algorithm\Sorting\InsertionSort\sort($array);
        $this->assertSame(isSorted($array, $sorted), true);

        $sorted = \Algorithm\Sorting\InsertionSort\sort2($array);
        $this->assertSame(isSorted($array, $sorted), true);
    }

    /**
     * @param array $array
     *
     * @dataProvider getRandomArray
     */
    public function testBubbleSort(array $array)
    {
        $sorted = \Algorithm\Sorting\BubbleSort\sort($array);
        $this->assertSame(isSorted($array, $sorted), true);
    }

    /**
     * @param array $array
     *
     * @dataProvider getRandomArray
     */
    public function testSelectionSort(array $array)
    {
        $sorted = \Algorithm\Sorting\SelectionSort\sort($array);
        $this->assertSame(isSorted($array, $sorted), true);
    }

    /**
     * @param array $array
     *
     * @dataProvider getRandomArray
     */
    public function testMergeSort(array $array)
    {
        $sorted = \Algorithm\Sorting\MergeSort($array);
        $this->assertSame(isSorted($array, $sorted), true);
    }

    /**
     * @param array $array
     *
     * @dataProvider getRandomArray
     */
    public function testShellSort(array $array)
    {
        $sorted = \Algorithm\Sorting\shellSort($array);
        $this->assertSame(isSorted($array, $sorted), true);
    }

}
