<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure\Support;

class TreeNode
{
    /**
     * @var mixed
     */
    public $value;

    /**
     * @var TreeNode[]
     */
    public $children = [];

    /**
     * @var TreeNode|null
     */
    public $left = null;

    /**
     * @var TreeNode|null
     */
    public $right = null;

    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Make a tree node.
     *
     * @param $value
     *
     * @return TreeNode
     */
    public static function make($value)
    {
        return new self($value);
    }

    /**
     * Add a child-node.
     *
     * @param TreeNode $node
     */
    public function addChild(TreeNode $node)
    {
        $this->children[] = $node;
    }

    /**
     * Attach a left-child.
     *
     * @param TreeNode $node
     */
    public function addLeftChild(TreeNode $node)
    {
        $this->left = $node;
    }

    /**
     * Attach a right-child.
     *
     * @param TreeNode $node
     */
    public function addRightChild(TreeNode $node)
    {
        $this->right = $node;
    }
}
