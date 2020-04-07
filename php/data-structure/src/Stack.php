<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure;

class Stack
{
    private $elements;

    /**
     * Push an item into stack.
     *
     * @param $element
     */
    public function push($element)
    {
        $this->elements[] = $element;
    }

    /**
     * Pop an item from stack.
     *
     * @return mixed
     */
    public function pop()
    {
        return array_pop($this->elements);
    }

    /**
     * Whether the stack is empty or not.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return 0 === count($this->elements);
    }
}
