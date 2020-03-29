<?php

namespace Littlesqx\Redis\ch06;

interface Throttler
{
    public function every($seconds);

    public function allow($number);

    public function then(\Closure $success, \Closure $fail);
}