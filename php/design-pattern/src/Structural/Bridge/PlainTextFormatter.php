<?php

namespace DesignPattern\Structural\Bridge;

class PlainTextFormatter implements FormatterInterface
{

    /**
     * @param string $text
     * @return string
     */
    public function format(string $text): string
    {
        return $text;
    }
}