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


use DesignPattern\Structural\DependencyInjection\DatabaseConfiguration;
use DesignPattern\Structural\DependencyInjection\DatabaseConnection;
use PHPUnit\Framework\TestCase;

class DependencyInjectionTest extends TestCase
{
    public function testDependencyInjection()
    {
        $config = new DatabaseConfiguration(
            'localhost',
            3306,
            'root',
            ''
        );
        $connection = new DatabaseConnection($config);

        $this->assertEquals('root:@localhost:3306', $connection->getDsn());
    }
}