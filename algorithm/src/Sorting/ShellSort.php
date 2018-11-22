<?php

namespace Algorithm\Sorting;

if (!function_exists('shellSort')) {

    function shellSort(array $values) : array
    {
        $len = count($values);
        $gap = (int) floor($len/2); // $len >> 1
        while ($gap >= 1) {
            for ($i = $gap; $i < $len; $i++) {
                $key = $values[$i];
                for ($j = $i - $gap; $j >= 0 && $values[$j] > $key; $j -= $gap) {
                    $values[$j + $gap] = $values[$j];
                }
                $values[$j+$gap] = $key;
            }
            $gap = (int) floor($gap/2); // $gap >> 1
        }
        return $values;
    }
}