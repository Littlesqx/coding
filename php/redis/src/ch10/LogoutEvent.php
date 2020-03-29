<?php

namespace Littlesqx\Redis\ch10;

class LogoutEvent
{
    private $user;

    private $logoutAt;

    public function __construct($user)
    {
        $this->user = $user;
        $this->logoutAt = date('Y-m-d H:i:s');
    }

    public function __toString()
    {
        return sprintf('User#%s logout at %s.', $this->user, $this->logoutAt);
    }
}