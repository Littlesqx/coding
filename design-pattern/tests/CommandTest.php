<?php

namespace DesignPattern\Tests;

use DesignPattern\Behavioral\Command\HelloCommand;
use DesignPattern\Behavioral\Command\Invoker;
use DesignPattern\Behavioral\Command\Receiver;
use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
{
    public function testInvocation()
    {
        $invoker = new Invoker();
        $receiver = new Receiver();

        $invoker->setCommand(new HelloCommand($receiver))->run();

        $this->assertEquals('Hello World', $receiver->getOutput());

        // enableDate
        $receiver = new Receiver();
        $receiver->enableDate();
        $invoker->setCommand(new HelloCommand($receiver))->run();
        $this->assertEquals(
            '['.date('Y-m-d').'] Hello World',
            $receiver->getOutput()
        );
    }
}