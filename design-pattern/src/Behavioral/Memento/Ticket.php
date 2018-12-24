<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Behavioral\Memento;


class Ticket
{
    private $currentState;

    public function __construct()
    {
        $this->currentState = new State(State::STATUS_CREATED);
    }

    public function open()
    {
        $this->currentState = new State(State::STATUS_OPENED);
    }

    public function assign()
    {
        $this->currentState = new State(State::STATUS_ASSIGNED);
    }

    public function close()
    {
        $this->currentState = new State(State::STATUS_CLOSED);
    }

    public function saveMemento(): Memento
    {
        return new Memento(clone $this->currentState);
    }

    public function restoreFromMemento(Memento $memento)
    {
        $this->currentState = $memento->getState();
    }

    public function getState(): State
    {
        return $this->currentState;
    }
}