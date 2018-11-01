<?php

namespace Algorithm\Sorting\BubbleSort;

/**
 * bubble sort.
 *
 * @param array $values
 * @return array
 */
function sort(array $values) : array
{
    $len = count($values);
    for ($i = 0; $i < $len; $i++) {
        for ($j = 0; $j < $len-$i-1; $j++) {
            if ($values[$j] > $values[$j+1]) {
                [$values[$j], $values[$j+1]] = [$values[$j+1], $values[$j]];
            }
        }
    }
    return $values;
}
