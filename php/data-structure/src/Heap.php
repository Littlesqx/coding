<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure;

abstract class Heap implements \Iterator, \Countable
{
    /**
     * @var array
     */
    private $heap = [];

    /**
     * Return the current element.
     *
     * @see https://php.net/manual/en/iterator.current.php
     *
     * @return mixed can return any type
     *
     * @since 5.0.0
     */
    public function current()
    {
        return $this->isEmpty() ? null : $this->top();
    }

    /**
     * Move forward to next element.
     *
     * @see https://php.net/manual/en/iterator.next.php
     * @since 5.0.0
     */
    public function next()
    {
        if ($this->isEmpty()) {
            // don't error, just silently stop
            return;
        }
        $this->extract();
    }

    /**
     * Return the key of the current element.
     *
     * @see https://php.net/manual/en/iterator.key.php
     *
     * @return mixed scalar on success, or null on failure
     *
     * @since 5.0.0
     */
    public function key()
    {
        return $this->count() - 1;
    }

    /**
     * Checks if current position is valid.
     *
     * @see https://php.net/manual/en/iterator.valid.php
     *
     * @return bool The return value will be casted to boolean and then evaluated.
     *              Returns true on success or false on failure.
     *
     * @since 5.0.0
     */
    public function valid(): bool
    {
        return !$this->isEmpty();
    }

    /**
     * Rewind the Iterator to the first element.
     *
     * @see https://php.net/manual/en/iterator.rewind.php
     * @since 5.0.0
     */
    public function rewind()
    {
        // Do nothing, the iterator always points to the top element
    }

    /**
     * Count elements of an object.
     *
     * @see https://php.net/manual/en/countable.count.php
     *
     * @return int The custom count as an integer.
     *             </p>
     *             <p>
     *             The return value is cast to an integer.
     *
     * @since 5.1.0
     */
    public function count(): int
    {
        return count($this->heap);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return 0 === $this->count();
    }

    public function extract()
    {
        if ($this->isEmpty()) {
            throw new \RuntimeException('Can\'t extract from an empty heap');
        }
        $result = $this->top();
        $end = $this->count() - 1;
        $this->swapElements(0, $end);
        unset($this->heap[$end]);
        $this->heapifyDown(0);

        return $result;
    }

    /**
     * @return mixed
     */
    public function top()
    {
        if ($this->isEmpty()) {
            throw new \RuntimeException('Can\'t peek at an empty heap');
        }

        return $this->heap[0];
    }

    public function insert($value): void
    {
        $index = $this->count();
        $this->heap[$index] = $value;
        $this->heapifyUp($index);
    }

    /**
     * @param $firstIndex
     * @param $secondIndex
     */
    private function swapElements($firstIndex, $secondIndex)
    {
        $temp = $this->heap[$secondIndex];
        $this->heap[$secondIndex] = $this->heap[$firstIndex];
        $this->heap[$firstIndex] = $temp;
    }

    private function heapifyUp($index)
    {
        if (0 !== $index) {
            $parentIndex = (int) floor(($index - 1) / 2);
            if ($this->compare($this->heap[$index], $this->heap[$parentIndex]) > 0) {
                $this->swapElements($index, $parentIndex);
                $this->heapifyUp($parentIndex);
            }
        }
    }

    private function heapifyDown($index)
    {
        $highestChildIndex = $this->getHighestChildIndex($index);
        if (null !== $highestChildIndex
            && $this->compare($this->heap[$highestChildIndex], $this->heap[$index]) > 0
        ) {
            $this->swapElements($highestChildIndex, $index);
            $this->heapifyDown($highestChildIndex);
        }
    }

    private function getHighestChildIndex($index)
    {
        $leftChildIndex = 2 * $index + 1;
        $rightChildIndex = 2 * $index + 2;

        if (isset($this->heap[$leftChildIndex])) {
            if (isset($this->heap[$rightChildIndex])
                && $this->compare($this->heap[$rightChildIndex], $this->heap[$leftChildIndex]) > 0
            ) {
                return $rightChildIndex;
            }

            return $leftChildIndex;
        }

        return null;
    }

    abstract public function compare($firstValue, $secondValue): int;
}
