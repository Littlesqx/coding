<?php

namespace Littlesqx\Redis\ch03;

use Predis\Client;

class Queue
{
    const QUEUE_PREFIX = 'notify-queue:';

    public function __construct()
    {
        \Swoole\Runtime::enableCoroutine();
        \Swoole\Timer::tick(1000, function () {
            $ids = $this->redis()->zrangebyscore(self::QUEUE_PREFIX.'delayed', 0, $nowTime = time());
            !empty($ids) && $this->redis()->zremrangebyscore(self::QUEUE_PREFIX.'delayed', 0, $nowTime);
            !empty($ids) && $this->redis()->lpush(self::QUEUE_PREFIX . 'waiting', $ids);
        });
    }

    protected function redis(array $options = [])
    {
        return new Client($options);
    }

    public function push($id, $delay = 0)
    {
        if ($delay > 0) {
            $this->redis()->zadd(self::QUEUE_PREFIX.'delayed', [$id => time()+$delay]);
        } else {
            $this->redis()->lpush(self::QUEUE_PREFIX . 'waiting', [$id]);
        }
    }

    public function pop()
    {
        $result =  $this->redis(['read_write_timeout' => 0])->brpop([self::QUEUE_PREFIX.'waiting'], 0);
        return $result[1] ?? null;
    }
}