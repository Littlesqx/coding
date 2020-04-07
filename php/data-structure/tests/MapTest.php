<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure\Test;

use Littlesqx\DataStructure\Map;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    public function testSet()
    {
        $map = new Map();
        $map->set('1', '1');
        $map->set(1, 1);
        $this->assertSame(2, $map->size());
        $this->assertSame('1', $map->get('1'));
        $this->assertSame(1, $map->get(1));
    }

    public function testGet()
    {
        $map = new Map();
        $map->set('1', '1');
        $map->set(1, 1);
        $this->assertSame(2, $map->size());
        $this->assertSame('1', $map->get('1'));
        $this->assertSame(1, $map->get(1));
    }

    public function testHas()
    {
        $map = new Map();
        $this->assertFalse($map->has('1'));
        $map->set('1', '1');
        $this->assertTrue($map->has('1'));
        $this->assertFalse($map->has(1));
        $map->set(1, 1);
        $this->assertTrue($map->has(1));
    }

    public function testClear()
    {
        $map = new Map();
        $map->set(1, 1);
        $this->assertSame(1, $map->size());
        $map->clear();
        $this->assertSame(0, $map->size());
    }

    public function testSize()
    {
        $map = new Map();
        $this->assertSame(0, $map->size());
        $map->set(1, 1);
        $this->assertSame(1, $map->size());
    }

    public function testDelete()
    {
        $map = new Map();
        $this->assertSame(0, $map->size());
        $map->set(1, 1);
        $this->assertSame(1, $map->size());
        $isDelete = $map->delete(1);
        $this->assertTrue($isDelete);
        $this->assertSame(0, $map->size());
        $isDelete = $map->delete(1);
        $this->assertFalse($isDelete);
    }

    public function testKeys()
    {
        $map = new Map();
        $map->set(1, 1);
        $map->set('1', 1);
        $this->assertSame([1, '1'], $map->keys());
    }

    public function testValues()
    {
        $map = new Map();
        $map->set(1, 1);
        $map->set('1', 1);
        $this->assertSame([1, 1], $map->values());
    }

    public function testEntries()
    {
        $map = new Map();
        $map->set(1, 1);
        $map->set('1', 1);
        $expected = [
            [1, 1],
            ['1', 1],
        ];
        foreach ($map->entries() as $i => [$k, $v]) {
            $this->assertSame($expected[$i], [$k, $v]);
        }
    }
}
