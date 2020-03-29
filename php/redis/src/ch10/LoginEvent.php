<?php

namespace Littlesqx\Redis\ch10;

class LoginEvent
{
    private $user;

    private $loginAt;

    public function __construct($user)
    {
        $this->user = $user;
        $this->loginAt = date('Y-m-d H:i:s');
    }

    public function __toString()
    {
        return sprintf('User#%s login at %s.', $this->user, $this->loginAt);
    }
}