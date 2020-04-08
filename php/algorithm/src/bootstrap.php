<?php

$includeFiles = [
    __DIR__ . "/Sorting/InsertionSort.php",
    __DIR__ . "/Sorting/BubbleSort.php",
    __DIR__ . "/Sorting/SelectionSort.php",
    __DIR__ . "/Sorting/MergeSort.php",
    __DIR__ . "/Sorting/ShellSort.php",
    __DIR__ . "/Sorting/QuickSort.php",
    __DIR__ . "/Sorting/HeapSort.php",
    __DIR__ . "/Recursion/Fib.php",
    __DIR__ . "/Search/BinarySearch.php",
    __DIR__ . "/Helper.php"
];

foreach ($includeFiles as $file) {
    require $file;
}