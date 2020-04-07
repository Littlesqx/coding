<?php

namespace Algorithm\Recursion;

function fib(int $n)
{
    return $n < 2 ? $n : fib($n - 1) + fib($n - 2);
}

function fibV2(int $n)
{
    static $cache = [];

    return $n < 2 ? $n : $cache[$n] ?? $cache[$n] = fibV2($n - 1) + fibV2($n - 2);
}

function fibV3(int $n)
{
    $preValue = 1;
    $prePreValue = 0;

    $loop = $n - 2;

    for ($i = 0; $i < $loop; $i++) {
        $temp = $preValue + $prePreValue;
        [$prePreValue, $preValue] = [$preValue, $temp];
    }

    return $prePreValue + $preValue;
}