<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure;

class Graph
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return \Generator
     */
    public function BFS()
    {
        $queue = new Queue();
        $visited = [];
        $size = count($this->data);
        for ($i = 0; $i < $size && count($visited) < $size; ++$i) {
            if (!array_key_exists($i, $visited)) {
                $queue->enqueue($i);
                $visited[$i] = true;
            }
            while (!$queue->isEmpty()) {
                $current = $queue->dequeue();
                yield $current;
                for ($j = 0; $j < $size; ++$j) {
                    if (!array_key_exists($j, $visited)
                        && 1 === $this->data[$current][$j]
                    ) {
                        $queue->enqueue($j);
                        $visited[$j] = true;
                    }
                }
            }
        }
    }

    /**
     * @return \Generator
     */
    public function DFS()
    {
        $stack = new Stack();
        $visited = [];
        $size = count($this->data);
        for ($i = 0; $i < $size && count($visited) < $size; ++$i) {
            if (!array_key_exists($i, $visited)) {
                $stack->push($i);
                $visited[$i] = true;
            }
            while (!$stack->isEmpty()) {
                $current = $stack->pop();
                yield $current;
                for ($j = 0; $j < $size; ++$j) {
                    if (!array_key_exists($j, $visited)
                        && 1 === $this->data[$current][$j]
                    ) {
                        $stack->push($j);
                        $visited[$j] = true;
                    }
                }
            }
        }
    }
}
