<?php

namespace DesignPattern\Creational\AbstractFactory;

abstract class AbstractTextFactory
{
    abstract public function createText(string $content);
}