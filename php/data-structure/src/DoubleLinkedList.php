<?php

namespace Littlesqx\DataStructure;

use Littlesqx\DataStructure\Support\Node;

class DoubleLinkedList
{
    /**
     * @var Node|null
     */
    private $head;

    /**
     * @var int
     */
    private $size = 0;

    public function __construct()
    {
        $this->head = Node::make(null);
    }

    /**
     * @param Node $node
     * @throws \Exception
     */
    public function addFirst(Node $node)
    {
        $this->add($node, 0);
    }

    /**
     * @param Node $node
     *
     * @throws \Exception
     */
    public function addLast(Node $node)
    {
        $this->add($node, $this->size);
    }

    /**
     * @param Node $node
     * @param int $index
     *
     * @throws \Exception
     */
    public function add(Node $node, int $index)
    {
        $temp = $this->getNode($index);

        $node->next = $temp->next;
        $temp->next = $node;
        $node->prev = $temp;

        $this->size++;
    }

    /**
     * @return Node|null
     * @throws \Exception
     */
    public function removeFirst()
    {
        $temp = $this->remove(0);

        return $temp;
    }

    /**
     * @param int $index
     *
     * @return Node|null
     * @throws \Exception
     */
    public function remove(int $index)
    {
        $temp = $this->getNode($index+1);

        $temp->prev && $temp->prev->next = $temp->next;
        $temp->next && $temp->next->prev = $temp->prev;

        $this->size--;

        return $temp;
    }

    public function removeNode(Node $node)
    {
        $node->prev && $node->prev->next = $node->next;
        $node->next && $node->next->prev = $node->prev;

        $this->size--;
    }

    /**
     * @return Node|null
     * @throws \Exception
     */
    public function removeLast()
    {
        $temp = $this->remove($this->size-1);

        return $temp;
    }

    public function traverse()
    {
        $pointer = $this->head->next;

        while ($pointer) {
            yield $pointer;
            $pointer = $pointer->next;
        }
    }

    /**
     * @param int $index
     * @return Node|null
     *
     * @throws \Exception
     */
    public function getNode(int $index)
    {
        if ($index < 0 || $index > $this->size) {
            throw new \Exception('Index value out of range.');
        }

        // 正向查找 （循环链表可以选择正反向查找优化一半时间复杂度）
        $temp = $this->head;
        while ($index--) {
            $temp = $temp->next;
        }

        return $temp;
    }

    public function getSize(): int
    {
        return $this->size;
    }

}
