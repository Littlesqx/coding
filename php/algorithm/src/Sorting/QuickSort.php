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
        $length = count($values);

        if ($length <= 1) {
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
