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


class CreateOrder extends StateOrder
{

    public function __construct()
    {
        $this->setStatus('created')
;    }

    protected function done()
    {
        static::$state = new ShippingOrder();
    }
}