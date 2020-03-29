<?php

namespace Littlesqx\Redis\ch06;

class LeakyBucketThrottler extends AbstractThrottler
{
    public function then(\Closure $success, \Closure $fail)
    {
        $luaScript = <<<LUA
local key = KEYS[1]
local capacity = tonumber(ARGV[1])
local rate = tonumber(ARGV[2])
local now = tonumber(ARGV[3])

local current = tonumber(redis.call('hget', key, 'current') or 0)
local last_time = tonumber(redis.call('hget', key, 'last_time') or 0)
local current = math.max(0, current - (now - last_time) * rate)

redis.call('hset', key, 'last_time', now)

if current < capacity then
    redis.call('hset', key, 'current', current + 1)
    return current + 1
end

return false
LUA;
        $this->redis->eval(
            $luaScript, 1, $this->key, 3,
            $this->allow / $this->every, time()
        ) ? $success() : $fail();

    }
}
