<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure;

class MaxHeap extends Heap
{
    public function compare($firstValue, $secondValue): int
    {
        return $firstValue <=> $secondValue;
    }
}
