<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Behavioral\State;


abstract class StateOrder
{
    private $details;

    /**
     * @var StateOrder
     */
    protected static $state;

    abstract protected function done();

    protected function setStatus(string $status)
    {
        $this->details['status'] = $status;
        $this->details['updated'] = time();
    }

    protected function getStatus(): string
    {
        return $this->details['status'];
    }
}