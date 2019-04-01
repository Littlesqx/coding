<?php

/*
 * This file is part of the data-structure-php.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Littlesqx\DataStructure;

use Traversable;

class Set implements \IteratorAggregate
{
    /**
     * @var array
     */
    private $elements;

    public function __construct(array $elements)
    {
        $uniqueElements = [];
        foreach ($elements as $element) {
            if (!in_array($element, $uniqueElements, true)) {
                $uniqueElements[] = $element;
            }
        }
        $this->elements = $uniqueElements;
    }

    /**
     * Add an item into Set.
     *
     * @param $value
     *
     * @return $this
     */
    public function add($value)
    {
        if (!in_array($value, $this->elements, true)) {
            $this->elements[] = $value;
        }
        return $this;
    }

    /**
     * Delete an item from Set.
     *
     * @param $value
     *
     * @return bool
     */
    public function delete($value)
    {
        $index = array_search($value, $this->elements, true);
        $isDelete = false !== $index;
        if ($isDelete) {
            unset($this->elements[$index]);
        }
        return $isDelete;
    }

    /**
     * Whether an item is exist or not.
     *
     * @param $value
     *
     * @return bool
     */
    public function has($value): bool
    {
        return in_array($value, $this->elements, true);
    }

    /**
     * Clear Set.
     */
    public function clear()
    {
        $this->elements = [];
    }

    /**
     * Retrieve an external iterator
     *
     * @return Traversable
     *
     * @since 5.0.0
     */
    public function getIterator()
    {
        return new \ArrayIterator(array_values($this->elements));
    }

    /**
     * Get the Set's size.
     *
     * @return int
     */
    public function size(): int
    {
        return count($this->elements);
    }
}