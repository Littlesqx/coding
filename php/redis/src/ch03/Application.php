<?php

namespace Littlesqx\Redis\ch03;

use Littlesqx\Redis\AbstractApplication;

class Application extends AbstractApplication
{

    public function run()
    {
        $queue = new Queue();

        go(function () use ($queue) {
            while (1) {
                $queue->push(rand(1, 10), rand(0, 3));
                sleep(2);
            }
        });

        go(function () use ($queue) {
            while (1) {
                $id = $queue->pop();
                var_dump($id);
            }
        });
    }
}