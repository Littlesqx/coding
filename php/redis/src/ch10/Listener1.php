<?php

namespace Littlesqx\Redis\ch10;

class Listener1 implements ListenerInterface
{

    /**
     * @return string[]
     */
    public function events()
    {
        return [
            LoginEvent::class,
            LogoutEvent::class,
        ];
    }

    /**
     * @param object $event
     *
     * @return mixed
     */
    public function handle(object $event)
    {
        echo sprintf("trigger event %s: ", get_class($event));
        echo (string) $event . "\n";
    }
}