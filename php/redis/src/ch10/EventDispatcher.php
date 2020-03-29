<?php

namespace Littlesqx\Redis\ch10;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\StoppableEventInterface;

class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @var ListenerProvider
     */
    private $listenerProvider;

    public function __construct(...$listeners)
    {
        $objects = [];
        foreach ($listeners as $listener) {
            $objects[] = new $listener();
        }

        $this->listenerProvider = new ListenerProvider(...$objects);
    }

    /**
     * Provide all relevant listeners with an event to process.
     *
     * @param object $event
     *   The object to process.
     *
     * @return object
     *   The Event that was passed, now modified by listeners.
     */
    public function dispatch(object $event)
    {
        foreach ($this->listenerProvider->getListenersForEvent($event) as $listener) {
            /**
             * @var $listener ListenerInterface
             */
            $listener->handle($event);
            if ($event instanceof StoppableEventInterface && $event->isPropagationStopped()) {
                break;
            }
        }

        return $event;
    }
}