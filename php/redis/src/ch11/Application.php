<?php

namespace Littlesqx\Redis\ch11;

use Littlesqx\Redis\AbstractApplication;
use phpDocumentor\Reflection\Types\Self_;
use Predis\Collection\Iterator\Keyspace;

class Application extends AbstractApplication
{
    const KEY_PREFIX = 'redis:ch11:';

    public function run()
    {
        // reset
        $reset = function () {
            !empty($keys = iterator_to_array(
                new Keyspace($this->redis, self::KEY_PREFIX . '*')
            )) && $this->redis->del($keys);
        };

        // quick start
        $reset();
        $pipe = $this->redis->pipeline();
        $pipe->multi();
        $pipe->set(self::KEY_PREFIX . 'books', 'iamastring');
        $pipe->incr(self::KEY_PREFIX . 'books');
        $pipe->set(self::KEY_PREFIX . 'poorman', 'iamsperate');
        $pipe->exec();
        $pipe->execute();
        var_dump($this->redis->get(self::KEY_PREFIX . 'books'));
        var_dump($this->redis->get(self::KEY_PREFIX . 'poorman'));

        echo "-------------\n";
        // discard
        $reset();
        $pipe = $this->redis->pipeline();
        $pipe->multi();
        $pipe->set(self::KEY_PREFIX . 'books', 'iamastring');
        $pipe->set(self::KEY_PREFIX . 'poorman', 'iamsperate');
        var_dump($this->redis->get(self::KEY_PREFIX . 'books'));
        var_dump($this->redis->get(self::KEY_PREFIX . 'poorman'));
        $pipe->discard();
        $pipe->execute();
        var_dump($this->redis->get(self::KEY_PREFIX . 'books'));
        var_dump($this->redis->get(self::KEY_PREFIX . 'poorman'));

        echo "-------------\n";

        // watch 乐观锁
        $reset();
        $this->redis->incr(self::KEY_PREFIX . 'books_number');
        var_dump($this->redis->get(self::KEY_PREFIX . 'books_number'));
        $tmp = $this->redis->watch(self::KEY_PREFIX . 'books_number');
        var_dump($tmp);
        $this->redis->incr(self::KEY_PREFIX . 'books_number');
        $pipe = $this->redis->pipeline();
        $pipe->multi();
        $pipe->incr(self::KEY_PREFIX . 'books_number');
        $pipe->exec();
        $result = $pipe->execute();
        var_dump($result, $this->redis->get(self::KEY_PREFIX . 'books_number'));
    }
}
