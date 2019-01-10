<?php

namespace DesignPattern\Creational\StaticFactory;

use DesignPattern\Creational\StaticFactory\Format\FormatNumber;
use DesignPattern\Creational\StaticFactory\Format\FormatString;
use DesignPattern\Creational\StaticFactory\Format\FormatType;

final class Factory
{
    public static function make(string $type): FormatInterface
    {
        if ($type === FormatType::STRING) {
            return new FormatString();
        }

        if ($type === FormatType::NUMBER) {
            return new FormatNumber();
        }

        throw new \InvalidArgumentException("{$type} is not a valid format type.");
    }
}