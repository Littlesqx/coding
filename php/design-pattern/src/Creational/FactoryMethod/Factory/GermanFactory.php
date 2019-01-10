<?php

namespace DesignPattern\Creational\FactoryMethod\Factory;

use DesignPattern\Creational\FactoryMethod\FactoryMethod;
use DesignPattern\Creational\FactoryMethod\Vehicle\Bicycle;
use DesignPattern\Creational\FactoryMethod\Vehicle\CarMercedes;
use DesignPattern\Creational\FactoryMethod\VehicleInterface;

class GermanFactory extends FactoryMethod
{

    /**
     * @param string $type
     * @return VehicleInterface
     */
    protected function createVehicle(string $type): VehicleInterface
    {
        switch ($type) {
            case parent::FAST:
                return new CarMercedes();
            case parent::CHEAP:
                return new Bicycle();
            default:
                throw new \InvalidArgumentException("{$type} is not a valid vehicle type.");
        }
    }
}