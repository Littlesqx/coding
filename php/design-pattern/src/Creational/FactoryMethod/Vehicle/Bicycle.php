<?php

namespace DesignPattern\Creational\FactoryMethod\Vehicle;

use DesignPattern\Creational\FactoryMethod\VehicleInterface;

class Bicycle implements VehicleInterface
{

    /**
     * @var string
     */
    private $color;

    public function setColor(string $rgb)
    {
        $this->color = $rgb;
    }
}