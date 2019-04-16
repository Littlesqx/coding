<?php

/*
 * This file is part of the data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Littlesqx\DataStructure\Problem\Collection;

class MergeSortedArrays
{
    /**
     * @var array
     */
    private $sortedArray1;

    /**
     * @var array
     */
    private $sortedArray2;

    public function __construct($sortedArray1, $sortedArray2)
    {
        $this->sortedArray1 = $sortedArray1;
        $this->sortedArray2 = $sortedArray2;
    }

    public function run()
    {
        $sortedArray = [];
        while ($this->sortedArray1 && $this->sortedArray2) {
            if ($this->sortedArray1[0] < $this->sortedArray2[0]) {
                $sortedArray[] = array_shift($this->sortedArray1);
            } else {
                $sortedArray[] = array_shift($this->sortedArray2);
            }
        }
        return array_merge($sortedArray, $this->sortedArray1, $this->sortedArray2);
    }
}