<?php

namespace DesignPattern\Behavioral\Command;

class Receiver
{
    /**
     * @var bool
     */
    private $enableDate = false;

    /**
     * @var string[]
     */
    private $output = [];

    /**
     * @param string $str
     */
    public function write(string $str)
    {
        if ($this->enableDate) {
            $str = '['. date('Y-m-d') .'] ' . $str;
        }
        $this->output[] = $str;
    }

    /**
     * @return string
     */
    public function getOutput() : string
    {
        return join("\n", $this->output);
    }

    public function enableDate()
    {
        $this->enableDate = true;
    }

    public function disableDate()
    {
        $this->enableDate = false;
    }

}