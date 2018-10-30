<?php

namespace Algorithm\Sorting\InsertionSort;

/**
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