<?php

namespace DesignPattern\Creational\Builder;

abstract class Vehicle
{
    /**
     * @var object[]
     */
    private $data = [];

    /**
     * @param string $key
     * @param object $value
     * @return $this
     */
    public function setPart($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }
}