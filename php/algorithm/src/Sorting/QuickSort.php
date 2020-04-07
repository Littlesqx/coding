<?php

/**
 * This file is part of coding.
 *
 * Copyright © 2012 - 2020 Xiaoman. All Rights Reserved.
 *
 * Created by Shengqian <shengqian@xiaoman.cn>, on 2020/04/03.
 */

namespace Algorithm\Sorting;

if (!function_exists('quickSort')) {

    /**
     * Quick sort.
     *
     * @param array $values
     *
     * @return array
     */
    function quickSort(array $values): array
    {
        if (($length = count($values)) <= 1) {
            return $values;
        }

        $less = $greater = [];
        $pivot = current($values);

        for ($i = 1; $i < $length; $i++) {
            $values[$i] < $pivot ? $less[] = $values[$i] : $greater[] = $values[$i];
        }

        return array_merge(quickSort($less), [$pivot], quickSort($greater));
    }
}

if (!function_exists('quickSortV2')) {
    /**
     * Quick sort (in-place).
     *
     * @param array $array
     *
     * @return array
     */
    function quickSortV2(array $array): array
    {
        ($func = function (array &$array, $low, $high) use (&$func) {
            if ($low < $high) {
                $pivot = partition($array, $low, $high);
                $func($array, $low, $pivot-1);
                $func($array, $pivot+1, $high);
            }
        })($array, 0, count($array) - 1);

        return $array;
    }

    /**
     * @param array $array
     * @param int $low
     * @param int $high
     *
     * @return int
     */
    function partition(array &$array, int $low, int $high): int
    {
        $pivot = $array[$low];

        while ($low < $high) {
            while ($low < $high && $array[$high] > $pivot) {
                $high--;
            }
            $array[$low] = $array[$high];
            while ($low < $high && $array[$low] <= $pivot) {
                $low++;
            }
            $array[$high] = $array[$low];
        }

        $array[$low] = $pivot;

        return $low;
    }
}
