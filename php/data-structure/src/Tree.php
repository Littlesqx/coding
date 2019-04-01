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


use Littlesqx\DataStructure\Support\TreeNode as Node;
use Littlesqx\DataStructure\Support\TreeNode;

class Tree
{
    public $root;

    public function __construct(Node $root)
    {
        $this->root = $root;
    }

    /**
     * Traverse the tree.
     *
     * @return \Generator
     */
    public function traversal()
    {
        yield from $this->traversalGenerator($this->root);
    }

    private function traversalGenerator(Node $node)
    {
        if ($node) {
            yield $node;
            foreach ($node->children as $child) {
                yield from $this->traversalGenerator($child);
            }
        }
    }

    /**
     * Traverse the tree in layer.
     *
     * @return \Generator
     */
    public function traversalInLayer()
    {
        $queue = new Queue();
        $queue->enqueue($this->root);
        while (!$queue->isEmpty()) {
            $current = $queue->dequeue();
            /** @var TreeNode $current */
            if ($current) {
                yield $current;
                foreach ($current->children as $child) {
                    $queue->enqueue($child);
                }
            }
        }
    }

    /**
     * Get leaf-nodes of the tree.
     *
     * @return \Generator
     */
    public function leaves()
    {
        yield from $this->leavesGenerator($this->root);
    }

    private function leavesGenerator(?Node $node)
    {
        if ($node) {
            if (count($node->children) === 0) {
                yield $node;
            } else {
                foreach ($node->children as $child) {
                    yield from $this->leavesGenerator($child);
                }
            }
        }
    }

    /**
     * Get depth of the tree.
     *
     * @return int|mixed
     */
    public function depth()
    {
        return $this->depthTraversal($this->root);
    }

    private function depthTraversal(?Node $node, $currentDepth = 0)
    {
        if ($node) {
            $currentDepth++;
            $childDepth = [];
            foreach ($node->children as $child) {
                $childDepth[] = $this->depthTraversal($child, $currentDepth);
            }
            $currentDepth = max($childDepth);
        }
        return $currentDepth;
    }
}