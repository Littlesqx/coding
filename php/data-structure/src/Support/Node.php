<?php

/*
 * This file is part of the data-structure-php.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Littlesqx\DataStructure\Support;

class Node
{
    /**
     * @var mixed
     */
    public $value;

    /**
     * @var null|Node
     */
    public $next = null;

    /**
     * @var null|Node
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