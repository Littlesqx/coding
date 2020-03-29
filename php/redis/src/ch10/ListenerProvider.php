<?php

namespace Littlesqx\Redis\ch10;


use Psr\EventDispatcher\ListenerProviderInterface;

class ListenerProvider implements ListenerProviderInterface
{
    /**
     * @var ListenerInterface[]
     */
    private $listeners;

    public function __construct(...$listeners)
    {
        $this->listeners = $listeners;
    }

    /**
     * @param object $event
     *   An event for which to return the relevant listeners.
     * @return iterable[callable]
     *   An iterable (array, iterator, or generator) of callables.  Each
     *   callable MUST be type-compatible with $event.
     */
    public function getListenersForEvent(object $event): iterable
    {
        foreach ($this->listeners as $listener) {
            if (in_array(get_class($event), $listener->events(), true)) {
                yield $listener;
            }
        }
    }
}