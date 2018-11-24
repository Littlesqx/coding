<?php

namespace DesignPattern\Behavioral\Command;

class HelloCommand implements CommandInterface
{

    /**
     * @var Receiver
     */
    private $output;

    public function __construct(Receiver $receiver)
    {
        $this->output = $receiver;
    }

    public function execute()
    {
        $this->output->write('Hello World');
    }
}