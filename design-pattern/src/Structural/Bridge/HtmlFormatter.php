<?php

namespace DesignPattern\Structural\Bridge;

class HtmlFormatter implements FormatterInterface
{

    /**
     * @param string $text
     * @return string
     */
    public function format(string $text): string
    {
        return sprintf('<p>%s</p>', $text);
    }
}