<?php

namespace DesignPattern\Creational\Builder\Builder;

use DesignPattern\Creational\Builder\BuilderInterface;
use DesignPattern\Creational\Builder\Parts\Car;
use DesignPattern\Creational\Builder\Parts\Door;
use DesignPattern\Creational\Builder\Parts\Engine;
use DesignPattern\Creational\Builder\Parts\Wheel;
use DesignPattern\Creational\Builder\Vehicle;

class CarBuilder implements BuilderInterface
{

    /**
     * @var Car
     */
    private $car;

    public function createVehicle()
    {
        $this->car = new Car();
    }

    public function addWheel()
    {
        $this->car->setPart('wheelLF', new Wheel())
            ->setPart('wheelRF', new Wheel())
            ->setPart('wheelLB', new Wheel())
            ->setPart('wheelRB', new Wheel());
    }

    public function addEngine()
    {
        $this->car->setPart('Engine', new Engine());
    }

    public function addDoors()
    {
        $this->car->setPart('rightDoor', new Door())
            ->setPart('leftDoor', new Door())
            ->setPart('trunkLid', new Door());
    }

    public function getVehicle() : Vehicle
    {
        return $this->car;
    }
}