<?php

namespace Littlesqx\Redis\ch08;

use Littlesqx\Redis\AbstractApplication;

class Application extends AbstractApplication
{

    public function run()
    {
        $keyPrefix = 'redis:ch08:scan:';
        foreach (range(1, 1000) as $i) {
            $this->redis->set($keyPrefix.$i, $i);
        }

        while (true) {
            [$cursor, $data] = $this->redis->scan($cursor ?? 0, [
                'MATCH' => $keyPrefix.'99*',
                'COUNT' => 100,
            ]);

            if (!empty($data)) {
                var_dump($data);
            }

            if ($cursor == 0) {
                break;
            }
        }
    }
}