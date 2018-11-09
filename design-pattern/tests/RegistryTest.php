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

use DesignPattern\Structural\Registry\Registry;
use PHPUnit\Framework\TestCase;

class RegistryTest extends TestCase
{
    public function testSetAndGetLogger()
    {
        $key = Registry::LOGGER;
        $logger = new \stdClass();

        Registry::set($key, $logger);
        $storedLogger = Registry::get($key);

        $this->assertSame($logger, $storedLogger);
        $this->assertInstanceOf(\stdClass::class, $storedLogger);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTrySetInvalidKey()
    {
        Registry::set('foo', new \stdClass());
    }

    /**
     * @runInSeparateProcess
     * @expectedException \InvalidArgumentException
     */
    public function testGetNotSetLogger()
    {
        Registry::get(Registry::LOGGER);
    }
}