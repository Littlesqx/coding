<?php

namespace DesignPattern\Tests;

use DesignPattern\Creational\FactoryMethod\Factory\GermanFactory;
use DesignPattern\Creational\FactoryMethod\Factory\ItalianFactory;
use DesignPattern\Creational\FactoryMethod\FactoryMethod;
use DesignPattern\Creational\FactoryMethod\Vehicle\Bicycle;
use DesignPattern\Creational\FactoryMethod\Vehicle\CarFerrari;
use DesignPattern\Creational\FactoryMethod\Vehicle\CarMercedes;
use PHPUnit\Framework\TestCase;

class FactoryMethodTest extends TestCase
{
    public function testCreateCheapVehicleInGermany()
    {
        $factory = new GermanFactory();
        $this->assertInstanceOf(
            Bicycle::class,
            $factory->create(FactoryMethod::CHEAP)
        );
    }

    public function testCreateFastVehicleInGermany()
    {
        $factory = new GermanFactory();
        $this->assertInstanceOf(
            CarMercedes::class,
            $factory->create(FactoryMethod::FAST)
        );
    }

    public function testCreateCheapVehicleInItaly()
    {
        $factory = new ItalianFactory();
        $this->assertInstanceOf(
            Bicycle::class,
            $factory->create(FactoryMethod::CHEAP)
        );
    }

    public function testCreateFastVehicleInItaly()
    {
        $factory = new ItalianFactory();
        $this->assertInstanceOf(
            CarFerrari::class,
            $factory->create(FactoryMethod::FAST)
        );
    }
}