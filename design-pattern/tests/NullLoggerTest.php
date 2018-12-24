<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Tests;


use DesignPattern\Behavioral\NullObject\NullLogger;
use DesignPattern\Behavioral\NullObject\PrintLogger;
use DesignPattern\Behavioral\NullObject\Service;
use PHPUnit\Framework\TestCase;

class NullLoggerTest extends TestCase
{
    public function testNullLogger()
    {
        $service = new Service(new NullLogger());
        $this->expectOutputString('');
        $service->doSomething();
    }

    public function testPrintLogger()
    {
        $service = new Service(new PrintLogger());
        $this->expectOutputString(sprintf("We are in %s::doSomething", Service::class));
        $service->doSomething();
    }
}