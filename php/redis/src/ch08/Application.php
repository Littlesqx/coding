<?php

namespace Littlesqx\Redis\ch08;

use Littlesqx\Redis\AbstractApplication;

class Application extends AbstractApplication
{

    public function run()
    {
        $keys = $this->redis->keys('redis:ch08:scan:*');
        $this->redis->del($keys);

        $keyPrefix = 'redis:ch08:scan:';
        foreach (range(1, 1000) as $i) {
            $this->redis->set($keyPrefix.$i, $i);
            $this->redis->hset('redis:ch08:scan:hash', rand(1, 1000), $i);
        }

        while (true) {
            [$cursor, $data] = $this->redis->scan($cursor ?? 0, [
                'MATCH' => $keyPrefix.'99*',
                'COUNT' => 2,
            ]);

            foreach ($data as $datum) {
                echo "$datum\n";
            }

            if ($cursor == 0) {
                break;
            }
        }

        echo "---------\n";

        $cursor = 0;
        while (true) {
            [$cursor, $data] = $this->redis->hscan('redis:ch08:scan:hash', $cursor, [
               'COUNT' => 2,
            ]);

            foreach ($data as $datum => $_) {
                echo "$datum\n";
            }

            if ($cursor == 0) {
                break;
            }
        }
    }
}