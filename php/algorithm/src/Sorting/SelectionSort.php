<?php

namespace Algorithm\Sorting\SelectionSort;

/**
 * selection sort.
 *
 * @param array $values
 * @return array
 */
function sort(array $values) : array
{
    $len = count($values);
    for ($i = 0; $i < $len; $i++) {
        $minIndex = $i;
        for ($j = $i + 1; $j < $len; $j++) {
            if ($values[$minIndex] > $values[$j]) {
                $minIndex = $j;
            }
        }
        [$values[$i], $values[$minIndex]] = [$values[$minIndex], $values[$i]];
    }
    return $values;
}
