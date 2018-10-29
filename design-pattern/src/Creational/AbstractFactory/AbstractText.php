<?php

namespace DesignPattern\Creational\AbstractFactory;

abstract class AbstractText
{
    /**
     * @var string
     */
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }
}