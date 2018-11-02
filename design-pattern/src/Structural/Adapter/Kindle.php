<?php

namespace DesignPattern\Structural\Adapter;

class Kindle implements EBookInterface
{
    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var int
     */
    private $totalPage = 100;

    public function unlock()
    {
        // ...
    }

    public function pressNext()
    {
        $this->page++;
    }

    /**
     * example: [1, 10]
     *
     * @return int[]
     */
    public function getPage(): array
    {
        return [$this->page, $this->totalPage];
    }
}