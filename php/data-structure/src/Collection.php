<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure;

use Traversable;

class Collection implements \IteratorAggregate, \Countable
{
    /**
     * @var array
     */
    private $elements;

    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    /**
     * Whether a offset exists.
     *
     * @param mixed $offset an offset to check for
     *
     * @return bool true on success or false on failure
     */
    public function exists(int $offset): bool
    {
        return array_key_exists($offset, $this->elements);
    }

    /**
     * Offset to retrieve.
     *
     * @param mixed $offset the offset to retrieve
     *
     * @return mixed can return all value types
     */
    public function get(int $offset)
    {
        return $this->elements[$offset] ?? null;
    }

    /**
     * Offset to set.
     *
     * @param int   $offset the offset to assign the value to
     * @param mixed $value  the value to set
     */
    public function set(int $offset, $value)
    {
        $this->elements[$offset] = $value;
    }

    /**
     * Offset to unset.
     *
     * @param int $offset the offset to unset
     */
    public function unset(int $offset)
    {
        unset($this->elements[$offset]);
    }

    /**
     * Push an item into the elements.
     *
     * @param mixed $value the value to push
     *
     * @return int the new numbers of elements
     */
    public function push($value)
    {
        return array_push($this->elements, $value);
    }

    /**
     * Pop an item from the elements.
     *
     * @return mixed the value to pop
     */
    public function pop()
    {
        return array_pop($this->elements);
    }

    /**
     * Count elements of an object.
     *
     * @return int the custom count as an integer
     */
    public function count(): int
    {
        return count($this->elements);
    }

    /**
     * Whether the elements is empty or not.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return 0 === count($this->elements);
    }

    /**
     * Collection Object to array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->elements;
    }

    /**
     * Retrieve an external iterator.
     *
     * @see https://php.net/manual/en/iteratoraggregate.getiterator.php
     *
     * @return Traversable an instance of an object implementing
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->elements);
    }
}
