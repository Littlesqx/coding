<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure\Test;

use Littlesqx\DataStructure\Queue;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    public function testCanEnAndDeQueue()
    {
        $queue = new Queue();
        $queue->enqueue(1);
        $queue->enqueue(2);
        $queue->enqueue(3);
        $this->assertSame(1, $queue->dequeue());
        $this->assertSame(2, $queue->dequeue());
        $queue->enqueue(4);
        $this->assertSame(3, $queue->dequeue());
        $this->assertSame(4, $queue->dequeue());
        $this->assertNull($queue->dequeue());
    }
}
