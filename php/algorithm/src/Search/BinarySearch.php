<?php

namespace Algorithm\Search;

function binarySearch(array $sortedArray, int $target): int
{
    $low = 0;
    $high = count($sortedArray) - 1;
    while ($low <= $high) {
        $mid = (int) (($low + $high) / 2);
        if ($sortedArray[$mid] > $target) {
            $high = $mid - 1;
        } elseif ($sortedArray[$mid] < $target) {
            $low = $mid + 1;
        } else {
            return $mid;
        }
    }

    return -1;
}