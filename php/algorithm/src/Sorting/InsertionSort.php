<?php

namespace Algorithm\Sorting\InsertionSort;

/**
 * insertion sort. (swap)
 *
 * @param array $values
 * @return array
 */
function sort(array $values) : array
{
    $len = count($values);
    for ($i = 1; $i < $len; $i++) {
        for ($j = 0; $j < $i; $j++) {
            if ($values[$i] < $values[$j]) {
                [$values[$j], $values[$i]] = [$values[$i], $values[$j]];
            }
        }
    }
    return $values;
}

/**
 * insertion sort. (cover)
 *
 * @param array $values
 * @return array
 */
function sort2(array $values) : array
{
    $len = count($values);
    for ($i = 1; $i < $len; $i++) {
        $key = $values[$i];
        for ($j = $i-1; $j >= 0 && $values[$j] > $key; $j--) {
            $values[$j+1] = $values[$j];
        }
        $values[$j+1] = $key;
    }
    return $values;
}
