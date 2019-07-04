<?php

namespace Littlesqx\Tests;

use Littlesqx\Psr\Log\EchoLogger;
use Littlesqx\Psr\Log\Foo;
use PHPUnit\Framework\TestCase;

class EchoLoggerTest extends TestCase
{
    /**
     * @test
     */
    public function can_echo_log_content()
    {
        $foo = new Foo(new EchoLogger());
        ob_start();
        $foo->bar();
        $actual = ob_get_clean();
        $this->assertNotEmpty($actual);
    }

}