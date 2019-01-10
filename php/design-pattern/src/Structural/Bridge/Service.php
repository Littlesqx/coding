<?php

namespace DesignPattern\Structural\Bridge;

abstract class Service
{
    /**
     * @var FormatterInterface
     */
    protected $formatter;

    public function __construct(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @param FormatterInterface $formatter
     */
    public function setFormatter(FormatterInterface $formatter): void
    {
        $this->formatter = $formatter;
    }

    abstract public function get(): string;
}