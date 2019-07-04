<?php

namespace Littlesqx\Redis;

use Predis\Client;

abstract class AbstractApplication
{
    /** @var Client */
    protected $redis;

    public function __construct()
    {
        $this->redis = new Client();
    }

    abstract public function run();
}