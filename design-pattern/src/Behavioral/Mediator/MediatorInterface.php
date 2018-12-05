<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Behavioral\Mediator;


interface MediatorInterface
{
    public function sendResponse(string $content);

    public function makeRequest();

    public function queryDb();
}