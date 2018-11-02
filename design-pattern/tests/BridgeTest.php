<?php

namespace DesignPattern\Tests;

use DesignPattern\Structural\Bridge\EchoService;
use DesignPattern\Structural\Bridge\HtmlFormatter;
use DesignPattern\Structural\Bridge\PlainTextFormatter;
use PHPUnit\Framework\TestCase;

class BridgeTest extends TestCase
{
    public function testUsingPlainTextFormatter()
    {
        $service = new EchoService(new PlainTextFormatter());
        $this->assertEquals('Hello World', $service->get());
    }

    public function testUsingHtmlFormatter()
    {
        $service = new EchoService(new HtmlFormatter());
        $this->assertEquals('<p>Hello World</p>', $service->get());
    }

    public function testSwitchFormatter()
    {
        $plainTextFormatter = new PlainTextFormatter();
        $service = new EchoService($plainTextFormatter);

        $service->setFormatter(new HtmlFormatter());
        $this->assertEquals('<p>Hello World</p>', $service->get());

        $service->setFormatter($plainTextFormatter);
        $this->assertEquals('Hello World', $service->get());
    }
}