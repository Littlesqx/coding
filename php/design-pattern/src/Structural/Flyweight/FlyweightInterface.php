<?php

namespace DesignPattern\Structural\Flyweight;

interface FlyweightInterface
{
    public function render(string $extrinsicState): string;
}