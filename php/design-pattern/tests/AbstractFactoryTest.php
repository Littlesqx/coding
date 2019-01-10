<?php

namespace DesignPattern\Tests;

use DesignPattern\Creational\AbstractFactory\Factory\HtmlFactory;
use DesignPattern\Creational\AbstractFactory\Text\HtmlText;
use DesignPattern\Creational\AbstractFactory\Factory\JsonFactory;
use DesignPattern\Creational\AbstractFactory\Text\JsonText;
use PHPUnit\Framework\TestCase;

class AbstractFactoryTest extends TestCase
{
    public function testCanCreateHtmlText()
    {
        $factory = new HtmlFactory();
        $text = $factory->createText('foobar');

        $this->assertInstanceOf(HtmlText::class, $text);
    }

    public function testCanCreateJsonText()
    {
        $factory = new JsonFactory();
        $text = $factory->createText('foobar');

        $this->assertInstanceOf(JsonText::class, $text);
    }
}