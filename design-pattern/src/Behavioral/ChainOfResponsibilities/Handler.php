<?php

namespace DesignPattern\Behavioral\ChainOfResponsibilities;

use Psr\Http\Message\RequestInterface;

abstract class Handler
{
    /**
     * @var Handler|null
     */
    private $successor = null;

    public function __construct(Handler $handler = null)
    {
        $this->successor = $handler;
    }

    /**
     * @param RequestInterface $request
     * @return mixed
     */
    final public function handle(RequestInterface $request)
    {
        $processed = $this->processing($request);

        if (null === $processed) {
            if (null !== $this->successor) {
                $processed = $this->successor->handle($request);
            }
        }

        return $processed;
    }

    abstract protected function processing(RequestInterface $request);
}