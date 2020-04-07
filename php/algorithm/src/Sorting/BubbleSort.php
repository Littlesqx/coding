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
        for ($j = 0; $j < $len - $i - 1; $j++) {
            if ($values[$j] > $values[$j+1]) {
                [$values[$j], $values[$j+1]] = [$values[$j+1], $values[$j]];
            }
        }
    }
    return $values;
}

/**
 * bubble sort V2.
 *
 * @param array $values
 * @return array
 */
function sortV2(array $values) : array
{
    $len = count($values);
    for ($i = 0, $exchange = true; $exchange && $i < $len; $i++) {
        for ($j = 0, $exchange = false; $j < $len - $i - 1; $j++) {
            if ($values[$j] > $values[$j+1]) {
                [$values[$j], $values[$j+1]] = [$values[$j+1], $values[$j]];
                $exchange = true;
            }
        }
    }
    return $values;
}
