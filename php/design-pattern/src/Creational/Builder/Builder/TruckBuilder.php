<?php

namespace DesignPattern\Creational\Builder\Builder;

use DesignPattern\Creational\Builder\BuilderInterface;
use DesignPattern\Creational\Builder\Parts\Door;
use DesignPattern\Creational\Builder\Parts\Engine;
use DesignPattern\Creational\Builder\Parts\Truck;
use DesignPattern\Creational\Builder\Parts\Wheel;
use DesignPattern\Creational\Builder\Vehicle;

class TruckBuilder implements BuilderInterface
{

    /**
     * @var Truck
     */
    private $truck;

    public function createVehicle()
    {
        $this->truck = new Truck();
    }

    public function addWheel()
    {
        $this->truck->setPart('wheel1', new Wheel())
            ->setPart('wheel2', new Wheel())
            ->setPart('wheel3', new Wheel())
            ->setPart('wheel4', new Wheel())
            ->setPart('wheel5', new Wheel())
            ->setPart('wheel6', new Wheel());
    }

    public function addEngine()
    {
        $this->truck->setPart('engine', new Engine());
    }

    public function addDoors()
    {
        $this->truck->setPart('rightDoor', new Door())
            ->setPart('leftDoor', new Door());
    }

    public function getVehicle() : Vehicle
    {
        return $this->truck;
    }
}
