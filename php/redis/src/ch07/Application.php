<?php

namespace Littlesqx\Redis\ch07;

use Littlesqx\Redis\AbstractApplication;

class Application extends AbstractApplication
{

    public function run()
    {
        $key = 'redis:ch07:company';
        $this->redis->geoadd($key, 116.48105, 39.996794, 'juejin');
        $this->redis->geoadd($key, 116.514203, 39.905409, 'ireader');
        $this->redis->geoadd($key, 116.489033, 40.007669, 'meituan');
        $this->redis->geoadd($key, 116.562108, 39.787602, 'jd');

        // location
        var_dump($this->redis->geopos($key, ['juejin']));

        // hash
        var_dump($this->redis->geohash($key, ['juejin']));

        // distance
        var_dump($this->redis->geodist($key, 'juejin', 'jd', 'km'));

        // near
        var_dump($this->redis->georadiusbymember($key, 'juejin', 10, 'km', [
            'COUNT' => 3,
            'SORT' => 'ASC',
            'WITHCOORD' => true,
            'WITHDIST' => true,
        ]));
    }
}