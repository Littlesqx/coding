<?php

namespace DesignPattern\Tests;

use DesignPattern\Creational\StaticFactory\Factory;
use DesignPattern\Creational\StaticFactory\Format\FormatNumber;
use DesignPattern\Creational\StaticFactory\Format\FormatString;
use DesignPattern\Creational\StaticFactory\Format\FormatType;
use PHPUnit\Framework\TestCase;

class StaticFactoryTest extends TestCase
{
    public function testCreateStringFormatter()
    {
        $this->assertInstanceOf(
            FormatString::class,
            Factory::make(FormatType::STRING)
        );
    }

    public function testCreateNumberFormatter()
    {
        $this->assertInstanceOf(
            FormatNumber::class,
            Factory::make(FormatType::NUMBER)
        );
    }

    public function testCreateInvalidFormatter()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('foo is not a valid format type.');

        Factory::make('foo');
    }
}