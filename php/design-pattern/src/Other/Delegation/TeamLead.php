<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Other\Delegation;


class TeamLead
{
    /**
     * @var JuniorDeveloper
     */
    private $junior;

    public function __construct(JuniorDeveloper $junior)
    {
        $this->junior = $junior;
    }

    public function writeCode():string
    {
        return $this->junior->writeBadCode();
    }
}