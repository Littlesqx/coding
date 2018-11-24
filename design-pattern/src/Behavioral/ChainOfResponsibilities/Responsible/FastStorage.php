<?php

namespace DesignPattern\Behavioral\ChainOfResponsibilities\Responsible;

use DesignPattern\Behavioral\ChainOfResponsibilities\Handler;
use Psr\Http\Message\RequestInterface;

class FastStorage extends Handler
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data, Handler $handler = null)
    {
        parent::__construct($handler);
        $this->data = $data;
    }

    /**
     * @param RequestInterface $request
     * @return mixed|null
     */
    protected function processing(RequestInterface $request)
    {
        $key = sprintf(
            '%s?%s',
            $request->getUri()->getPath(),
            $request->getUri()->getQuery()
        );
        if ('GET' === $request->getMethod() && isset($this->data[$key])) {
            return $this->data[$key];
        }
        return null;
    }
}