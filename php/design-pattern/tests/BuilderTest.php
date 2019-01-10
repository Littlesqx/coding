<?php

namespace DesignPattern\Tests;

use DesignPattern\Creational\Builder\Builder\CarBuilder;
use DesignPattern\Creational\Builder\Builder\TruckBuilder;
use DesignPattern\Creational\Builder\Director;
use DesignPattern\Creational\Builder\Parts\Car;
use DesignPattern\Creational\Builder\Parts\Truck;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    public function testBuildTruck()
    {
        $truckBuilder = new TruckBuilder();
        $vehicle = (new Director())->build($truckBuilder);
        $this->assertInstanceOf(Truck::class, $vehicle);
    }

    public function testBuildCar()
    {
        $carBuilder = new CarBuilder();
        $vehicle = (new Director())->build($carBuilder);
        $this->assertInstanceOf(Car::class, $vehicle);
    }
}