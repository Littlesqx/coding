<?php

namespace Littlesqx\Redis\ch05;

use Littlesqx\Redis\AbstractApplication;

class Application extends AbstractApplication
{
    const UV_KEY = 'redis:ch05:uv';

    public function run()
    {
        $this->redis->del([self::UV_KEY]);

        $expectedCount = 0;
        foreach (range(1, 100000) as $i) {
            $this->redis->pfadd(self::UV_KEY, [sprintf('user%d', $i)]);
            $expectedCount++;
        }

        $count = $this->redis->pfcount([self::UV_KEY]);

        echo "$count, $expectedCount\n";
    }

}
