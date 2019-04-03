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

use Littlesqx\DataStructure\Stack;
use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    public function testCanPushAndPopStack()
    {
        $stack = new Stack();
        $stack->push(1);
        $stack->push(2);
        $stack->push(3);
        $this->assertSame(3, $stack->pop());
        $this->assertSame(2, $stack->pop());
        $stack->push(4);
        $this->assertSame(4, $stack->pop());
        $this->assertSame(1, $stack->pop());
        $this->assertNull($stack->pop());
    }
}