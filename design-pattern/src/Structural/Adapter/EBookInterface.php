<?php

namespace DesignPattern\Structural\Adapter;

interface EBookInterface
{
    public function unlock();

    public function pressNext();

    /**
     * example: [1, 10]
     *
     * @return int[]
     */
    public function getPage(): array;
}