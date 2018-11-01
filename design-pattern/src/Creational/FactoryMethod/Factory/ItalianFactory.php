<?php

namespace DesignPattern\Creational\FactoryMethod\Factory;

use DesignPattern\Creational\FactoryMethod\FactoryMethod;
use DesignPattern\Creational\FactoryMethod\Vehicle\Bicycle;
use DesignPattern\Creational\FactoryMethod\Vehicle\CarFerrari;
use DesignPattern\Creational\FactoryMethod\VehicleInterface;

class ItalianFactory extends FactoryMethod
{

    /**
     * create a vehicle
     *
     * @param string $type
     * @return VehicleInterface
     */
    protected function createVehicle(string $type): VehicleInterface
    {
        switch ($type) {
            case parent::FAST:
                return new CarFerrari();
            case parent::CHEAP:
                return new Bicycle();
            default:
                throw new \InvalidArgumentException("{$type} is not a valid vehicle type.");
        }
    }
}