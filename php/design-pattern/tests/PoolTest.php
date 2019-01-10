<?php

namespace DesignPattern\Tests;

use DesignPattern\Creational\Pool\WorkerPool;
use PHPUnit\Framework\TestCase;

class PoolTest extends TestCase
{
    public function testGetNewWorker()
    {
        $pool = new WorkerPool();
        $worker1 = $pool->get();
        $worker2 = $pool->get();
        $this->assertCount(2, $pool);
        $this->assertNotSame($worker1, $worker2);
    }

    public function testGetSameWorker()
    {
        $pool = new WorkerPool();
        $worker1 = $pool->get();
        $pool->dispose($worker1);
        $worker2 = $pool->get();
        $this->assertCount(1, $pool);
        $this->assertSame($worker1, $worker2);
    }
}