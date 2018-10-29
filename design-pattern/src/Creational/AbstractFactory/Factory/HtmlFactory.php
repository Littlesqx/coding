<?php

namespace DesignPattern\Creational\AbstractFactory\Factory;

use DesignPattern\Creational\AbstractFactory\AbstractTextFactory;
use DesignPattern\Creational\AbstractFactory\Text\HtmlText;

class HtmlFactory extends AbstractTextFactory
{
    public function createText(string $content): HtmlText
    {
        return new HtmlText($content);
    }
}