<?php

namespace Algorithm\Sorting;

if (!function_exists('mergeSort')) {

    /**
     * mergeSort.
     *
     * @param array $values
     * @return array
     */
    function mergeSort(array $values) : array
    {
        $len = count($values);
        if ($len < 2) {
            return $values;
        }
        [$left, $right] = array_chunk($values, ceil($len/2));
        $left = mergeSort($left);
        $right = mergeSort($right);
        $merge = [];
        while ($left && $right) {
            if ($left[0] < $right[0]) {
                $merge[] = array_shift($left);
            } else {
                $merge[] = array_shift($right);
            }
        }
        return array_merge($merge, $left, $right);
    }
}

