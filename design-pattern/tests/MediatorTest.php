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


use DesignPattern\Behavioral\Mediator\Mediator;
use DesignPattern\Behavioral\Mediator\Subsystem\Client;
use DesignPattern\Behavioral\Mediator\Subsystem\Database;
use DesignPattern\Behavioral\Mediator\Subsystem\Server;
use PHPUnit\Framework\TestCase;

class MediatorTest extends TestCase
{
    public function testOutputHelloWorld()
    {
        $client = new Client();
        new Mediator(new Database(), $client, new Server());

        $this->expectOutputString('Hello World');

        $client->request();
    }
}