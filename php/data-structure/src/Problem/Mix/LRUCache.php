<?php

namespace Littlesqx\DataStructure\Problem\Mix;

use Littlesqx\DataStructure\DoubleLinkedList;
use Littlesqx\DataStructure\HashTable;
use Littlesqx\DataStructure\Support\Node;

class LRUCache
{
    protected $cacheTable;

    protected $cacheLink;

    protected $capacity;

    public function __construct(int $capacity = 10)
    {
        $this->capacity = $capacity;

        $this->cacheTable = new HashTable();
        $this->cacheLink = new DoubleLinkedList();
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @throws \Exception
     */
    public function put(string $key, string $value)
    {
        $node = Node::make([$key, $value]);
        if ($this->cacheTable->has($key)) {
            $cacheNode = $this->cacheTable->get($key);
            $this->cacheLink->removeNode($cacheNode);
        } elseif ($this->isFull()) {
            $cacheNode = $this->cacheLink->removeLast();
            [$oldKey, ] = $cacheNode->value;
            $this->cacheTable->remove($oldKey);
        }
        $this->cacheLink->addFirst($node);
        $this->cacheTable->put($key, $node);
    }

    /**
     * @param string $key
     *
     * @return mixed|null
     * @throws \Exception
     */
    public function get(string $key)
    {
        if (!$this->cacheTable->has($key)) {
            return null;
        }

        $cacheNode = $this->cacheTable->get($key);

        [, $value] = $cacheNode->value;
        $this->put($key, $value);

        return $value;
    }

    protected function isFull()
    {
        return $this->cacheTable->size() === $this->capacity;
    }

    public function display()
    {
        foreach ($this->cacheLink->traverse() as $node) {
            echo sprintf("(%s, %s)\n", $node->value[0], $node->value[1]);
        }
    }
}