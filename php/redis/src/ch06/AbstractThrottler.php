<?php


namespace Littlesqx\Redis\ch06;

use Predis\Client;

abstract class AbstractThrottler implements Throttler
{
    const KEY_PREFIX = 'redis:ch06:throttler:';

    protected $key;

    protected $redis;

    protected $every;

    protected $allow;

    public function __construct(Client $redis, $key)
    {
        $this->redis = $redis;

        $this->key = self::KEY_PREFIX . $key;
    }

    public function every($seconds)
    {
        $this->every = $seconds;

        return $this;
    }

    public function allow($number)
    {
        $this->allow = $number;

        return $this;
    }

}