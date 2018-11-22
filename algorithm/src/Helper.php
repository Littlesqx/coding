<?php

namespace Algorithm;

use Faker\Factory;

if (!function_exists('arraySame')) {
    /**
     * @param array $left
     * @param array $right
     * @param bool $cmpOrder
     * @return bool
     */
    function arraySame(array $left, array $right, $cmpOrder = true) : bool
    {
        if (count($left) !== count($right)) {
            return false;
        }
        $left = array_values($left);
        $right = array_values($right);
        if ($cmpOrder) {
            $len = count($left);
            for ($i = 0; $i < $len; $i++) {
                if ($left[$i] !== $right[$i]) {
                    return false;
                }
            }
            return true;
        }
        return empty(array_diff($left, $right));
    }
}

if (!function_exists('randomIntArray')) {
    /**
     * @param int $size
     * @return array
     */
    function randomIntArray(int $size) : array
    {
        $out = [];
        $faker = Factory::create();
        for ($i = 0; $i < $size; $i++) {
            $out[] = $faker->numberBetween(1, 1000);
        }
        return $out;
    }
}

if (!function_exists('isSorted')) {
    /**
     * @param array $origin
     * @param array $sorted
     * @return bool
     */
    function isSorted(array $origin, array $sorted) : bool
    {
        sort($origin);
        return arraySame($sorted, $origin);
    }
}
