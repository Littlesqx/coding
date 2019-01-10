<?php

namespace DesignPattern\Tests;

use DesignPattern\Behavioral\ChainOfResponsibilities\Handler;
use DesignPattern\Behavioral\ChainOfResponsibilities\Responsible\FastStorage;
use DesignPattern\Behavioral\ChainOfResponsibilities\Responsible\SlowStorage;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class ChainTest extends TestCase
{
    /**
     * @var Handler
     */
    private $chain;

    protected function setUp()
    {
        $this->chain = new FastStorage(
            ['foo/bar?index=1' => 'Hello FastStorage!'],
            new SlowStorage()
        );
    }

    public function testCanRequestKeyInFastStorage()
    {
        $uri = $this->createMock(UriInterface::class);
        $uri->method('getPath')->willReturn('foo/bar');
        $uri->method('getQuery')->willReturn('index=1');

        $request = $this->createMock(RequestInterface::class);
        $request->method('getMethod')->willReturn('GET');
        $request->method('getUri')->willReturn($uri);

        $this->assertEquals('Hello FastStorage!', $this->chain->handle($request));
    }

    public function testCanRequestKeyInSlowStorage()
    {
        $uri = $this->createMock(UriInterface::class);
        $uri->method('getPath')->willReturn('foo/baz');
        $uri->method('getQuery')->willReturn('');

        $request = $this->createMock(RequestInterface::class);
        $request->method('getMethod')->willReturn('GET');
        $request->method('getUri')->willReturn($uri);

        $this->assertEquals('Hello SlowStorage!', $this->chain->handle($request));
    }
}