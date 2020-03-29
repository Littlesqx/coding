<?php

namespace Littlesqx\Redis\ch06;

class SlidingWindowThrottler extends AbstractThrottler
{
    public function then(\Closure $success, \Closure $fail)
    {
        $luaScript = <<<LUA
local key = KEYS[1]
local every = tonumber(ARGV[1])
local allow = tonumber(ARGV[2])
local now = tonumber(ARGV[3])

redis.call('zremrangebyscore', key, 0, now - every)
local current = tonumber(redis.call('zcard', key) or 0)
if current < allow then
    redis.call('zadd', key, now, now)
end

redis.call('expire', key, every)

return current < allow
LUA;

        $this->redis->eval($luaScript, 1, $this->key, $this->every, $this->allow, microtime(true))
            ? $success() : $fail();
    }
}
