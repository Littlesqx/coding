<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Tests;


use DesignPattern\Other\Delegation\JuniorDeveloper;
use DesignPattern\Other\Delegation\TeamLead;
use PHPUnit\Framework\TestCase;

class DelegationTest extends TestCase
{
    public function testHowTeamLeadWriteCode()
    {
        $junior = new JuniorDeveloper();
        $teamLead = new TeamLead($junior);

        $this->assertEquals($junior->writeBadCode(), $teamLead->writeCode());
    }
}