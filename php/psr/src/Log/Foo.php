<?php

namespace Littlesqx\Psr\Log;

use Psr\Log\LoggerInterface;

class Foo
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = $logger;
    }

    public function bar()
    {
        $this->logger->info('Doing something', ['foo' => '哈哈']);
    }
}