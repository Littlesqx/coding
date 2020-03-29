<?php

namespace Littlesqx\Redis\ch10;

use Littlesqx\Redis\AbstractApplication;
use Predis\Client;
use Predis\PubSub\DispatcherLoop;

class Application extends AbstractApplication
{
    public function run()
    {
        \Swoole\Runtime::enableCoroutine();

        // event dispatcher
        \Swoole\Coroutine::create(function () {
            $pubSub = $this->redis(['read_write_timeout' => 0])->pubSubLoop();
            $dispatcher = new DispatcherLoop($pubSub);
            $dispatcherProxy = new EventDispatcher(new Listener1());
            $dispatcher->attachCallback('events', function ($payload) use ($dispatcherProxy) {
                $dispatcherProxy->dispatch(unserialize($payload));
            });

            // Attach a function to control the dispatcher loop termination with a message.
            $dispatcher->attachCallback('control', function ($payload) use ($dispatcher) {
                if ($payload === 'terminate_dispatcher') {
                    echo "stop dispatcher\n";
                    $dispatcher->stop();
                }
            });

            $dispatcher->run();
        });

        // event trigger
        \Swoole\Coroutine::create(function () {
            // login
            $this->redis()->publish('events', serialize(new LoginEvent(1)));
            // do something...
            sleep(2);
            // logout
            $this->redis()->publish('events', serialize(new LogoutEvent(1)));

            sleep(2);
            $this->redis()->publish('control', 'terminate_dispatcher');
        });
    }

    /**
     * @param array $options
     *
     * @return Client
     */
    protected function redis(array $options = [])
    {
        return new Client($options);
    }
}