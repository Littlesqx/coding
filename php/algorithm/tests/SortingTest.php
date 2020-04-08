<?php

namespace Algorithm\Tests;

use function Algorithm\isSorted;
use function Algorithm\randomIntArray;
use function Algorithm\Sorting\heapSort;
use function Algorithm\Sorting\quickSort;
use function Algorithm\Sorting\quickSortV2;
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
        $this->assertTrue(isSorted($array, $sorted));

        $sorted = \Algorithm\Sorting\BubbleSort\sortV2($array);
        $this->assertTrue(isSorted($array, $sorted));
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

    /**
     * @param array $array
     *
     * @dataProvider getRandomArray
     */
    public function testQuickSort(array $array)
    {
        $sorted = quickSort($array);

        $this->assertTrue(isSorted($array, $sorted));

        $sorted = quickSortV2($array);
        $this->assertTrue(isSorted($array, $sorted));
    }

    /**
     * @param array $array
     *
     * @dataProvider getRandomArray
     */
    public function testHeapSort(array $array)
    {
        $sorted = heapSort($array);

        $this->assertTrue(isSorted($array, $sorted));
    }
}
