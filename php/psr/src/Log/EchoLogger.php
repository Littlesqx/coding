<?php

namespace Littlesqx\Psr\Log;

use Carbon\Carbon;
use Psr\Log\AbstractLogger;

class EchoLogger extends AbstractLogger
{

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        echo sprintf(
            "[%s] [%s] %s %s\n",
            Carbon::now('PRC'),
            $level,
            $message,
            \json_encode($context, JSON_UNESCAPED_UNICODE)
        );
    }
}