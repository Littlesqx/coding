<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure\Test;

use Littlesqx\DataStructure\BinaryTree;
use Littlesqx\DataStructure\Support\TreeNode;
use PHPUnit\Framework\TestCase;

class BinaryTreeTest extends TestCase
{
    /**
     * @var BinaryTree
     */
    private $tree;

    protected function setUp(): void
    {
        $node1 = TreeNode::make(1);
        $node2 = TreeNode::make(2);
        $node3 = TreeNode::make(3);
        $node4 = TreeNode::make(4);
        $node5 = TreeNode::make(5);
        $node6 = TreeNode::make(6);
        $node7 = TreeNode::make(7);
        $node8 = TreeNode::make(8);
        $node1->addLeftChild($node2);
        $node1->addRightChild($node3);
        $node2->addLeftChild($node4);
        $node2->addRightChild($node5);
        $node5->addLeftChild($node7);
        $node5->addRightChild($node8);
        $node3->addRightChild($node6);
        $this->tree = new BinaryTree($node1);
        parent::setUp();
    }

    public function testPreOrderTraversal()
    {
        $actual = [];
        foreach ($this->tree->preOrderTraversal() as $node) {
            /* @var TreeNode $node */
            $actual[] = $node->value;
        }
        $this->assertSame([1, 2, 4, 5, 7, 8, 3, 6], $actual);
    }

    public function testPostOrderTraversal()
    {
        $actual = [];
        foreach ($this->tree->postOrderTraversal() as $node) {
            /* @var TreeNode $node */
            $actual[] = $node->value;
        }
        $this->assertSame([4, 7, 8, 5, 2, 6, 3, 1], $actual);
    }

    public function testInOrderTraversal()
    {
        $actual = [];
        foreach ($this->tree->inOrderTraversal() as $node) {
            /* @var TreeNode $node */
            $actual[] = $node->value;
        }
        $this->assertSame([4, 2, 7, 5, 8, 1, 3, 6], $actual);
    }

    public function testTraversalInLayer()
    {
        $actual = [];
        foreach ($this->tree->traversalInLayer() as $node) {
            /* @var TreeNode $node */
            $actual[] = $node->value;
        }

        $this->assertSame([1, 2, 3, 4, 5, 6, 7, 8], $actual);
    }

    public function testLeaves()
    {
        $actual = [];
        foreach ($this->tree->leaves() as $node) {
            /* @var TreeNode $node */
            $actual[] = $node->value;
        }

        $this->assertSame([4, 7, 8, 6], $actual);
    }

    public function testDepth()
    {
        $this->assertSame(4, $this->tree->depth());
    }
}
