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
        for ($j = 0; $j < $i + 1; $j++) {
            if ($values[$j] > $values[$i]) {
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
        for ($j = $i; $j > 0 && $values[$j-1] > $key; $j--) {
            $values[$j] = $values[$j-1];
        }
        $values[$j] = $key;
    }
    return $values;
}



