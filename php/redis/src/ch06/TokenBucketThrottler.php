<?php

namespace Littlesqx\Redis\ch06;


class TokenBucketThrottler extends AbstractThrottler
{

    public function then(\Closure $success, \Closure $fail)
    {
        $luaScript = <<<LUA
local key = KEYS[1]
local capacity = ARGV[1]
local rate = ARGV[2]
local now = ARGV[3]

local left = tonumber(redis.call('hget', key, 'left') or 0)
local last_time = tonumber(redis.call('hget', key, 'last_time') or 0)
local current = math.min(capacity, left + (now - last_time) * rate)

redis.call('hset', key, 'last_time', now)

if current > 0 then
    redis.call('hset', key, 'left', current - 1)
    return true
end

return false
LUA;
        $this->redis->eval($luaScript, 1, $this->key, 2,
            $this->allow / $this->every, microtime(true)
        ) ? $success() : $fail();

    }
}