<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Behavioral\Visitor;


class RoleVisitor implements RoleVisitorInterface
{

    private $visited = [];

    public function visitUser(User $user)
    {
        $this->visited[] = $user;
    }

    public function visitGroup(Group $role)
    {
        $this->visited[] = $role;
    }

    public function getVisited(): array
    {
        return $this->visited;
    }
}