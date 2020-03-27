<?php

namespace Littlesqx\Redis\ch02;

use Littlesqx\Redis\AbstractApplication;

class Application extends AbstractApplication
{

    public function run()
    {
//        var_dump($this->redis->set('lock:codehole', true, 'ex', 5, 'nx'));
//        var_dump($this->redis->set('lock:codehole', true, 'ex', 5, 'nx'));
//        var_dump($this->redis->del(['lock:codehole']));

        $tag = 'lock:codehole:tag';

        if ($this->redis->set('lock:codehole', $tag, 'ex', 10, 'nx')) {
            // do something
            echo getmypid() . ": I have the lock. \n";
            $i = 0;
            while ($i++ < 3) {
                echo "$i\n";
                sleep(1);
            }

            var_dump($this->delIfEqualsAtomicity('lock:codehole', $tag));

            return;
        }

        echo getmypid() . ": I can not have the lock. \n";;

    }

    public function delIfEquals($key, $tag)
    {
        // # !! not atomicity
        $tag == $this->redis->get($key) && $this->redis->del($key);
    }

    public function delIfEqualsAtomicity($key, $tag)
    {
        return $this->redis->eval(
            '
            -- delifequals
            if redis.call("get", KEYS[1]) == ARGV[1] then
                return redis.call("del", KEYS[1])
            else
                return 0
            end
            ',
            1,
            $key,
            $tag
        );
    }
}