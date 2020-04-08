<?php

namespace Algorithm\Sorting;

/**
 * Heap Sort.
 *
 * @param array $array
 *
 * @return array
 */
function heapSort(array $array): array
{
    $maxHeapify = function (array &$array, int $low, int $high) {
        $dad = $low;
        $son = $dad * 2 + 1;
        while ($son <= $high) {
            if ($son + 1 <= $high && $array[$son + 1] >= $array[$son]) {
                $son++;
            }
            if ($array[$dad] > $array[$son]) {
                return;
            } else {
                [$array[$son], $array[$dad]] = [$array[$dad], $array[$son]];
                [$dad, $son] = [$son, $son * 2 + 1];
            }
        }
    };

    $len = count($array);
    for ($i = $len / 2 - 1; $i >= 0; $i--) {
        $maxHeapify($array, $i, $len - 1);
    }

    for ($i = $len - 1; $i >= 0; $i--) {
        [$array[0], $array[$i]] = [$array[$i], $array[0]];
        $maxHeapify($array, 0, $i - 1);
    }

    return $array;
}