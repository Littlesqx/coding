<?php

namespace Littlesqx\Redis\ch06;

class FixedWindowThrottler extends AbstractThrottler
{
    public function then(\Closure $success, \Closure $fail)
    {
        $luaScript = <<<LUA
local key = KEYS[1]
local every = tonumber(ARGV[1])
local allow = tonumber(ARGV[2])
local current = tonumber(redis.call('get', key) or 0)
if current+1 > allow then
    return false
else
    redis.call('incrby', key, 1)
    redis.call('expire', key, every)
    return true
end
LUA;

        $this->redis->eval($luaScript, 1, $this->key, $this->every, $this->allow)
            ? $success() : $fail();
    }
}
