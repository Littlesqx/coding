<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure\Support;

class Node
{
    /**
     * @var mixed
     */
    public $value;

    /**
     * @var Node|null
     */
    public $next = null;

    /**
     * @var Node|null
     */
    public $prev = null;

    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Make a tree node.
     *
     * @param $value
     *
     * @return Node
     */
    public static function make($value)
    {
        return new self($value);
    }
}
