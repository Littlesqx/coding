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

class BinaryTree
{
    public $root = null;

    public function __construct(Node $root)
    {
        $this->root = $root;
    }

    /**
     * Pre-order traverse the tree.
     *
     * @return \Generator
     */
    public function preOrderTraversal()
    {
        yield from $this->preOrderTraversalGenerator($this->root);
    }

    private function preOrderTraversalGenerator(?Node $node)
    {
        if ($node) {
            yield $node;
            yield from $this->preOrderTraversalGenerator($node->left);
            yield from $this->preOrderTraversalGenerator($node->right);
        }
    }

    /**
     * In-order traverse the tree.
     *
     * @return \Generator
     */
    public function inOrderTraversal()
    {
        yield from $this->inOrderTraversalGenerator($this->root);
    }

    private function inOrderTraversalGenerator(?Node $node)
    {
        if ($node) {
            yield from $this->preOrderTraversalGenerator($node->left);
            yield $node;
            yield from $this->preOrderTraversalGenerator($node->right);
        }
    }

    /**
     * Post-order traverse the tree.
     *
     * @return \Generator
     */
    public function postOrderTraversal()
    {
        yield from $this->postOrderTraversalGenerator($this->root);
    }

    private function postOrderTraversalGenerator(?Node $node)
    {
        if ($node) {
            yield from $this->postOrderTraversalGenerator($node->left);
            yield from $this->postOrderTraversalGenerator($node->right);
            yield $node;
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
            /** @var $current TreeNode|null */
            if ($current) {
                yield $current;
                $queue->enqueue($current->left);
                $queue->enqueue($current->right);
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
            if ($node->left) {
                yield from $this->leavesGenerator($node->left);
            }
            if ($node->right) {
                yield from $this->leavesGenerator($node->right);
            }
            if (is_null($node->left) && is_null($node->right)) {
                yield $node;
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
            $currentDepth = max(
                $this->depthTraversal($node->left, $currentDepth),
                $this->depthTraversal($node->right, $currentDepth)
            );
        }
        return $currentDepth;
    }
}