<?php

namespace DesignPattern\Structural\Bridge;

class EchoService extends Service
{

    public function get(): string
    {
        return $this->formatter->format('Hello World');
    }
}