<?php

namespace Littlesqx\Redis\ch04;


use Predis\Client;
use Predis\Collection\Iterator\Keyspace;

class SignService
{
    const SIGN_KEY_PREFIX = 'redis:ch04:sign:';

    protected $redis;

    public function __construct(Client $redis)
    {
        $this->redis = $redis;
    }

    public function signOn($id, $time = null)
    {
        $day = date('Ymd', $time ?: time());

        $this->redis->setbit(self::SIGN_KEY_PREFIX.$day, $id, 1);
    }

    public function getWeeklyStatistics()
    {
        // 过去一周的时间（包括今天）
        $keys = [];
        foreach (range(-6, 0) as $index) {
            $keys[] = self::SIGN_KEY_PREFIX.date('Ymd', strtotime("{$index} day"));
        }
        $this->redis->bitop('OR', 'last_week_count', $keys);
        return $this->redis->bitcount('last_week_count');
    }

    public function getMonthlyStatistics()
    {
        $keyPattern = sprintf('%s*', self::SIGN_KEY_PREFIX.date('Ym'));
        $keys = iterator_to_array(new Keyspace($this->redis, $keyPattern, 10));

        if (count($keys) > 0) {
            $this->redis->bitop('OR', 'this_month_count', $keys);
            return $this->redis->bitcount('this_month_count');
        }

        return 0;
    }
}