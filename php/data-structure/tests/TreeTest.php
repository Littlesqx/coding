<?php

/*
 * This file is part of the coding.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Littlesqx\DataStructure\Test;

use Littlesqx\DataStructure\Support\TreeNode;
use Littlesqx\DataStructure\Tree;
use PHPUnit\Framework\TestCase;

class TreeTest extends TestCase
{
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
        $node9 = TreeNode::make(9);

        $node1->addChild($node2);
        $node1->addChild($node3);
        $node1->addChild($node4);
        $node2->addChild($node5);
        $node2->addChild($node6);
        $node2->addChild($node7);
        $node3->addChild($node8);
        $node5->addChild($node9);

        $this->tree = new Tree($node1);
        parent::setUp();
    }
}