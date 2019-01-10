<?php

namespace DesignPattern\Structural\Bridge;

interface FormatterInterface
{
    public function format(string $text): string;
}