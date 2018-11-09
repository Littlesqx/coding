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

use DesignPattern\Structural\Flyweight\FlyweightFactory;
use PHPUnit\Framework\TestCase;

class FlyweightTest extends TestCase
{
    private $characters = ['a', 'b', 'c'];

    private $fonts = ['Arial', 'Times New Roman', 'Verdana'];

    public function testFlyweight()
    {
        $factory = new FlyweightFactory();
        foreach ($this->characters as $character) {
            foreach ($this->fonts as $font) {
                $flyweight = $factory->get($character);
                $rendered = $flyweight->render($font);
                $this->assertEquals(
                    sprintf('Character %s with font %s', $character, $font),
                    $rendered
                );
            }
        }
        $this->assertCount(count($this->characters), $factory);
    }
}