<?php

namespace Algorithm;

use Faker\Factory;

if (!function_exists('array_same')) {
    /**
     * @param array $left
     * @param array $right
     * @param bool $cmpOrder
     * @return bool
     */
    function array_same(array $left, array $right, $cmpOrder = true) : bool
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

if (!function_exists('generate_random_int_array')) {
    /**
     * @param int $size
     * @return array
     */
    function generate_random_int_array(int $size) : array
    {
        $out = [];
        $faker = Factory::create();
        for ($i = 0; $i < $size; $i++) {
            $out[] = $faker->numberBetween(1, 1000);
        }
        return $out;
    }
}
