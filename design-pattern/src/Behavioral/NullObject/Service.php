<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Behavioral\NullObject;


class Service
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function doSomething()
    {
        $this->logger->log('We are in '.__METHOD__);
    }
}