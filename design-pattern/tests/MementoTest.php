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


use DesignPattern\Behavioral\Memento\State;
use DesignPattern\Behavioral\Memento\Ticket;
use PHPUnit\Framework\TestCase;

class MementoTest extends TestCase
{
    public function testOpenTicketAssignAndSetBackToOpen()
    {
        $ticket = new Ticket();
        $ticket->open();

        $openState = $ticket->getState();
        $this->assertEquals(State::STATUS_OPENED, (string) $ticket->getState());

        $memento = $ticket->saveMemento();

        $ticket->assign();
        $this->assertEquals(State::STATUS_ASSIGNED, (string) $ticket->getState());

        $ticket->restoreFromMemento($memento);
        $this->assertEquals((string) $openState, (string) $ticket->getState());
    }
}