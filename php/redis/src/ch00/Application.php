<?php

namespace Littlesqx\Redis\ch00;

use Littlesqx\Redis\AbstractApplication;

class Application extends AbstractApplication
{

    public function run()
    {
        // # say hello
        echo "say hello: \n";
        var_dump($this->redis->get('say'));
        $this->redis->set('say', 'Hello world');
        var_dump($this->redis->get('say'));
    }
}