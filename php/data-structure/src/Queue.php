<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure;

class Queue
{
    /**
     * @var array
     */
    private $elements = [];

    /**
     * Push an item into queue.
     *
     * @param $element
     */
    public function enqueue($element)
    {
        array_push($this->elements, $element);
    }

    /**
     * Pop an item from queue.
     *
     * @return mixed
     */
    public function dequeue()
    {
        return array_shift($this->elements);
    }

    /**
     * Whether the queue is empty or not.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return 0 === count($this->elements);
    }
}
