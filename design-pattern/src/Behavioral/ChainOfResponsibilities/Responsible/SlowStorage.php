<?php

namespace DesignPattern\Behavioral\ChainOfResponsibilities\Responsible;

use DesignPattern\Behavioral\ChainOfResponsibilities\Handler;
use Psr\Http\Message\RequestInterface;

class SlowStorage extends Handler
{

    /**
     * @param RequestInterface $request
     * @return string
     */
    protected function processing(RequestInterface $request)
    {
        // maybe fetch from db or file system
        return 'Hello SlowStorage!';
    }
}