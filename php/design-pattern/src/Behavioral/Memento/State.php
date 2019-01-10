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


class State
{
    const STATUS_CREATED = 'created';

    const STATUS_OPENED = 'opened';

    const STATUS_ASSIGNED = 'assigned';

    const STATUS_CLOSED = 'closed';

    private $state;

    private static $validStates = [
        self::STATUS_CREATED,
        self::STATUS_OPENED,
        self::STATUS_ASSIGNED,
        self::STATUS_CLOSED,
    ];

    public function __construct(string $state)
    {
        self::ensureIsValidState($state);
        $this->state = $state;
    }

    private static function ensureIsValidState(string $state)
    {
        if (!in_array($state, self::$validStates, true)) {
            throw new \InvalidArgumentException('Invalid state given');
        }
    }

    public function __toString(): string
    {
        return $this->state;
    }
}