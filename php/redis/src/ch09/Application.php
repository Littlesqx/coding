<?php

namespace Littlesqx\Redis\ch09;

use Littlesqx\Redis\AbstractApplication;
use Predis\Client;

class Application extends AbstractApplication
{
    public function run()
    {
        \Swoole\Runtime::enableCoroutine();

        // consumer
        \Swoole\Coroutine::create(function () {
            $pubSub = $this->redis(['read_write_timeout' => 0])->pubSubLoop();
            $pubSub->subscribe('control_channel', 'notifications');

            foreach ($pubSub as $message) {
                switch ($message->kind) {
                    case 'subscribe':
                        echo "Subscribed to {$message->channel}", PHP_EOL;
                        break;

                    case 'message':
                        if ($message->channel == 'control_channel') {
                            if ($message->payload == 'quit_loop') {
                                echo 'Aborting pubsub loop...', PHP_EOL;
                                $pubSub->unsubscribe();
                            } else {
                                echo "Received an unrecognized command: {$message->payload}.", PHP_EOL;
                            }
                        } else {
                            echo "Received the following message from {$message->channel}:",
                            PHP_EOL, "  {$message->payload}", PHP_EOL, PHP_EOL;
                        }
                        break;
                }
            }
        });

        // producer
        \Swoole\Coroutine::create(function () {
            foreach (range(1, 3) as $index) {
                $this->redis()->publish('notifications', 'message ' . $index);
                sleep(1);
            }
            $this->redis()->publish('control_channel', 'quit_loop');
        });
    }

    protected function redis(array $options = [])
    {
        return new Client($options);
    }
}