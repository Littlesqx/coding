<?php

/*
 * This file is part of the coding.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Tests;

use DesignPattern\Structural\Facade\BiosInterface;
use DesignPattern\Structural\Facade\Facade;
use DesignPattern\Structural\Facade\OsInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FacadeTest extends TestCase
{
    public function testComputerOn()
    {
        /**
         * @var OsInterface|MockObject $os
         */
        $os = $this->createMock(OsInterface::class);
        $os->method('getName')
            ->will($this->returnValue('Linux'));
        /**
         * @var BiosInterface $bios
         */
        $bios = $this->getMockBuilder(BiosInterface::class)
            ->setMethods([
                'launch',
                'execute',
                'waitForKeyPress'
            ])
            ->disableAutoload()
            ->getMock();
        $bios->expects($this->once())
            ->method('launch')
            ->with($os);
        $facade = new Facade($os, $bios);
        $facade->turnOn();

        $this->assertEquals('Linux', $os->getName());
    }
}