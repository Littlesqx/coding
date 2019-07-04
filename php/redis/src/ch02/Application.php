<?php

namespace Littlesqx\Redis\ch02;

use Littlesqx\Redis\AbstractApplication;

class Application extends AbstractApplication
{

    public function run()
    {
        var_dump($this->redis->set('lock:codehole', true, 'ex', 5, 'nx'));
        var_dump($this->redis->set('lock:codehole', true, 'ex', 5, 'nx'));
        var_dump($this->redis->del(['lock:codehole']));

        $tag = uniqid();
        if ($this->redis->set('lock:codehole', $tag, 'ex', 5, 'nx')) {
            // do something
            // # !! not atomicity
            $tag == $this->redis->get('lock:codehole') && $this->redis->del('lock:codehole');
        }
        var_dump($this->redis->get('lock:codehole'));
    }
}