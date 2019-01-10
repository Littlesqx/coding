<?php

namespace DesignPattern\Creational\AbstractFactory\Factory;

use DesignPattern\Creational\AbstractFactory\AbstractTextFactory;
use DesignPattern\Creational\AbstractFactory\Text\JsonText;

class JsonFactory extends AbstractTextFactory
{
    public function createText(string $content): JsonText
    {
        return new JsonText($content);
    }
}