<?php

namespace DesignPattern\Creational\FactoryMethod;

abstract class FactoryMethod
{
    const FAST = 'fast';

    const CHEAP = 'cheap';

    abstract protected function createVehicle(string $type) : VehicleInterface;

    public function create(string $type) : VehicleInterface
    {
        $vehicle = $this->createVehicle($type);
        $vehicle->setColor('black');
        return $vehicle;
    }
}