<?php

namespace DesignPattern\Behavioral\Command;

class Invoker
{
    /**
     * @var CommandInterface
     */
    private $command;

    /**
     * @param CommandInterface $cmd
     * @return $this
     */
    public function setCommand(CommandInterface $cmd)
    {
        $this->command = $cmd;
        return $this;
    }

    public function run()
    {
        $this->command->execute();
    }
}