<?php

/*
 * This file is part of the data-structure-php.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Littlesqx\DataStructure\Test;

use Littlesqx\DataStructure\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testTraversable()
    {
        $collection = new Collection([1, 2, 3]);

        $this->assertTrue($collection instanceof \Traversable);

        $currentIndex = 0;
        $currentValue = 1;
        foreach ($collection as $key => $value) {
            $this->assertSame([$currentIndex++, $currentValue++], [$key, $value]);
        }
    }

    public function testOffsetExists()
    {
        $collection = new Collection([1, 2, 3 => 3]);
        $this->assertTrue($collection->exists(0));
        $this->assertTrue($collection->exists(1));
        $this->assertTrue($collection->exists(3));
        $this->assertFalse($collection->exists(2));
    }

    public function testGet()
    {
        $collection = new Collection([1, 2, 3 => 3]);
        $this->assertSame(1, $collection->get(0));
        $this->assertSame(2, $collection->get(1));
        $this->assertSame(3, $collection->get(3));
    }

    public function testSetAndUnset()
    {
        $collection = new Collection([1, 2, 3 => 3]);
        $collection->set(3, 4);
        $this->assertSame(4, $collection->get(3));
        $collection->unset(3);
        $this->assertNull($collection->get(3));
    }

    public function testPopAndPush()
    {
        $collection = new Collection([1, 2, 3]);
        $popItem = $collection->pop();
        $this->assertSame(3, $popItem);
        $this->assertSame([1, 2], $collection->toArray());
        $currentCount = $collection->push(3);
        $this->assertSame(3, $currentCount);
        $collection->pop();
        $collection->pop();
        $collection->pop();
        $this->assertEmpty($collection->toArray());
        $collection->pop();
        $this->assertEmpty($collection->toArray());
    }

    public function testCountable()
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertInstanceOf(\Countable::class, $collection);
        $this->assertSame(3, $collection->count());
        $this->assertSame(3, count($collection));
    }

    public function testIsEmpty()
    {
        $collection = new Collection([1]);
        $this->assertFalse($collection->isEmpty());
        $collection->pop();
        $this->assertTrue($collection->isEmpty());
    }

    public function testToArray()
    {
        $collection = new Collection([1]);
        $this->assertTrue(is_array($collection->toArray()));
        $this->assertSame([1], $collection->toArray());
    }
}