<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure\Problem\Collection;

class FindKthNumber
{
    /**
     * @var array
     */
    private $items;

    /**
     * @var int
     */
    private $kTh;

    public function __construct(array $items, int $kTh)
    {
        $this->items = $items;
        $this->kTh = $kTh;
    }

    public function run()
    {
        $size = count($this->items);
        if ($this->kTh > $size) {
            throw new \InvalidArgumentException("kTh number: {$this->kTh} is larger than the size of items.");
        }
        for ($i = 0; $i < $this->kTh; ++$i) {
            for ($j = 0; $j < $size - $i - 1; ++$j) {
                if ($this->items[$j + 1] < $this->items[$j]) {
                    [$this->items[$j + 1], $this->items[$j]] = [$this->items[$j], $this->items[$j + 1]];
                }
            }
        }

        return $this->items[$size - $this->kTh];
    }
}
