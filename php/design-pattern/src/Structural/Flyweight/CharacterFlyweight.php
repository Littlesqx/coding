<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Structural\Flyweight;

class CharacterFlyweight implements FlyweightInterface
{

    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $font
     *
     * @return string
     */
    public function render(string $font): string
    {
        return sprintf('Character %s with font %s', $this->name, $font);
    }
}