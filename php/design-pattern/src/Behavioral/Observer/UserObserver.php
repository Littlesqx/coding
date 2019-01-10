<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Behavioral\Observer;


use SplSubject;

class UserObserver implements \SplObserver
{

    private $changeUsers = [];

    /**
     * Receive update from subject
     * @link https://php.net/manual/en/splobserver.update.php
     *
     * @param SplSubject $subject <p>
     * The <b>SplSubject</b> notifying the observer of an update.
     * </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function update(SplSubject $subject)
    {
        $this->changeUsers[] = clone $subject;
    }

    public function getChangedUsers(): array
    {
        return $this->changeUsers;
    }
}