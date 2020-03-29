<?php

namespace Littlesqx\Redis\ch10;


interface ListenerInterface
{
    /**
     * @return string[]
     */
    public function events();

    /**
     * @param object $event
     *
     * @return mixed
     */
    public function handle(object $event);
}