<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure\Test;

use Littlesqx\DataStructure\Set;
use PHPUnit\Framework\TestCase;

class SetTest extends TestCase
{
    public function testAdd()
    {
        $set = new Set([]);
        $this->assertFalse($set->has(1));
        $set->add(1);
        $this->assertTrue($set->has(1));
        $this->assertSame(1, $set->size());
        $set->add(1);
        $this->assertSame(1, $set->size());
        $set->add('1');
        $this->assertSame(2, $set->size());
    }

    public function testDelete()
    {
        $set = new Set([1]);
        $this->assertFalse($set->delete(2));
        $this->assertTrue($set->delete(1));
        $this->assertFalse($set->delete(1));
    }

    public function testHas()
    {
        $set = new Set([1, [1], new \stdClass()]);
        $this->assertTrue($set->has(1));
        $this->assertTrue($set->has([1]));
        $this->assertFalse($set->has(new \stdClass()));
        $this->assertFalse($set->has(0));
    }

    public function testClear()
    {
        $set = new Set([1, [1], new \stdClass()]);
        $this->assertSame(3, $set->size());
        $set->clear();
        $this->assertSame(0, $set->size());
    }

    public function testSize()
    {
        $set = new Set([1, [1], new \stdClass()]);
        $this->assertSame(3, $set->size());
        $set->add(2);
        $this->assertSame(4, $set->size());
    }

    public function testTraversal()
    {
        $set = new Set([1, [1], new \stdClass(), 'S']);
        $expected = [1, [1], new \stdClass(), 'S'];
        foreach ($set as $k => $v) {
            $this->assertTrue(
                $expected[$k] === $v || $v instanceof \stdClass
            );
        }
    }
}
