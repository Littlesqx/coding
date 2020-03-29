<?php

namespace Littlesqx\Redis\ch06;

use Littlesqx\Redis\AbstractApplication;

class Application extends AbstractApplication
{
    public function run()
    {
        $throttler = new FixedWindowThrottler($this->redis, 'fixed_window');
        foreach (range(1, 20) as $_) {
            $throttler->every(10)
                ->allow(5)
                ->then(function () {
                    echo "success\n";
                }, function () {
                    echo "fail\n";
                });
            sleep(1);
        }

        $throttler = new SlidingWindowThrottler($this->redis, 'sliding_window');
        foreach (range(1, 20) as $_) {
            $throttler->every(10)
                ->allow(5)
                ->then(function () {
                    echo "success\n";
                }, function () {
                    echo "fail\n";
                });
            sleep(1);
        }

        $this->redis->del([LeakyBucketThrottler::KEY_PREFIX.'leaky_bucket']);
        $throttler = new LeakyBucketThrottler($this->redis, 'leaky_bucket');
        foreach (range(1, 20) as $_) {
            $throttler->every(10)
                ->allow(5)
                ->then(function () {
                    echo "success\n";
                }, function () {
                    echo "fail\n";
                });
            sleep(rand(1, 2));
        }

        $throttler = new TokenBucketThrottler($this->redis, 'token_bucket');
        foreach (range(1, 20) as $_) {
            $throttler->every(10)
                ->allow(10)
                ->then(function () {
                    echo "success\n";
                }, function () {
                    echo "fail\n";
                });
            $throttler->then(function () {
                echo "success 2\n";
            }, function () {
                echo "fail 2\n";
            });
            sleep(1);
        }
    }
}
