<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure;

use Littlesqx\DataStructure\Support\Node;

class LinkedList
{
    /**
     * @var Node|null
     */
    private $head;

    /**
     * @var Node|null
     */
    private $last;

    /**
     * @var int
     */
    private $size = 0;

    public function __construct()
    {
        $head = Node::make(0);
        $this->head = $head;
        $this->last = $head;
    }

    /**
     * Get size of the linkedList.
     *
     * @return int
     */
    public function size(): int
    {
        return $this->size;
    }

    /**
     * Link a node in the linkedList.
     *
     * @param Node $node
     *
     * @return $this
     */
    public function add(Node $node): self
    {
        $node->next = $this->last->next;
        $this->last->next = $node;
        $this->last = $node;
        ++$this->size;

        return $this;
    }

    /**
     * Remove the specified node from the linkedList.
     *
     * @param int $index
     *
     * @return bool
     */
    public function remove(int $index): bool
    {
        $current = $this->head;
        $nextIndex = 0;
        while ($current->next) {
            if ($nextIndex === $index) {
                $current->next = $current->next->next;
                --$this->size;

                return true;
            }
            $current = $current->next;
            ++$nextIndex;
        }

        return false;
    }

    /**
     * Insert a node at the specified position of the linkedList.
     *
     * @param int  $index
     * @param Node $node
     *
     * @return bool
     */
    public function insert(int $index, Node $node): bool
    {
        $current = $this->head;
        $nextIndex = 0;
        while ($current) {
            if ($nextIndex === $index) {
                $node->next = $current->next;
                $current->next = $node;
                ++$this->size;

                return true;
            }
            $current = $current->next;
            ++$nextIndex;
        }

        return false;
    }

    /**
     * Get node-values with array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $elements = [];
        $current = $this->head->next;
        while ($current) {
            $elements[] = $current->value;
            $current = $current->next;
        }

        return $elements;
    }
}
