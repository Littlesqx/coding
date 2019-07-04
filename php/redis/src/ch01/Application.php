<?php

namespace Littlesqx\Redis\ch01;

use Littlesqx\Redis\AbstractApplication;

class Application extends AbstractApplication
{
    public function run()
    {
        // # string
        // ## key => value
        echo "string \n";
        $this->redis->set('name', 'codehole');
        var_dump($this->redis->exists('name'));
        $this->redis->del(['name']);
        var_dump($this->redis->get('name'));

        // ## batch key => value
        $this->redis->set('name1', 'codehole');
        $this->redis->set('name2', 'holycode');
        var_dump($this->redis->mget(['name1', 'name2', 'name3']));

        $this->redis->mset([
            'name1' => 'boy',
            'name2' => 'girl',
            'name3' => 'unknown',
        ]);
        var_dump($this->redis->mget(['name1', 'name2', 'name3']));

        // ## expire set
        $this->redis->set('name', 'codehole');
        var_dump($this->redis->get('name'));
        $this->redis->expire('name', 5);
        sleep(4);
        var_dump($this->redis->get('name'));
        sleep(1);
        var_dump($this->redis->get('name'));

        $this->redis->setex('name', 5, 'codehole');
        var_dump($this->redis->get('name'));
        sleep(5);
        var_dump($this->redis->get('name'));

        // ## count
        $this->redis->set('age', 30);
        var_dump($this->redis->get('age'));
        $this->redis->incr('age');
        var_dump($this->redis->get('age'));
        $this->redis->incrby('age', 5);
        var_dump($this->redis->get('age'));
        $this->redis->incrby('age', -5);
        var_dump($this->redis->get('age'));
        $this->redis->set('age', 9223372036854775807);
        // $this->redis->incr('age');

        echo "-------------\n";

        // # list
        // ## queue
        $this->redis->rpush('books', ['python', 'java', 'golang']);
        var_dump($this->redis->llen('books'));
        var_dump($this->redis->lpop('books'));
        var_dump($this->redis->lpop('books'));
        var_dump($this->redis->lpop('books'));
        var_dump($this->redis->lpop('books'));

        // ## stack
        $this->redis->rpush('books', ['python', 'java', 'golang']);
        var_dump($this->redis->llen('books'));
        var_dump($this->redis->rpop('books'));
        var_dump($this->redis->rpop('books'));
        var_dump($this->redis->rpop('books'));
        var_dump($this->redis->rpop('books'));

        // ## indexing (slow operation)
        $this->redis->rpush('books', ['python', 'java', 'golang']);
        var_dump($this->redis->lindex('books', 1));
        var_dump($this->redis->lrange('books', 0, -1));
        var_dump($this->redis->ltrim('books', 1, -1));
        var_dump($this->redis->lrange('books', 0, -1));
        var_dump($this->redis->ltrim('books', 1, 0));
        var_dump($this->redis->llen('books'));

        echo "-------------\n";

        // # hash
        $this->redis->hset('hash_books', 'java', 'think in java');
        $this->redis->hset('hash_books', 'golang', 'concurrency in go');
        $this->redis->hset('hash_books', 'python', 'python cookbook');
        var_dump($this->redis->hgetall('hash_books'));
        var_dump($this->redis->hlen('hash_books'));
        var_dump($this->redis->hget('hash_books', 'python'));
        var_dump($this->redis->hset('hash_books', 'python', 'python cookbook 2'));
        var_dump($this->redis->hget('hash_books', 'python'));
        $this->redis->hmset('hash_books', [
            'java' => 'think in java 2',
            'python' => 'python cookbook 3',
            'golang' => 'concurrency in go 2',
        ]);
        var_dump($this->redis->hgetall('hash_books'));

        // # set
        $this->redis->sadd('set_books', ['python', 'java', 'golang']);
        var_dump($this->redis->smembers('set_books'));
        var_dump($this->redis->sismember('set_books', 'php'));
        var_dump($this->redis->sismember('set_books', 'python'));
        var_dump($this->redis->scard('set_books'));
        var_dump($this->redis->srem('set_books', 'python'));
        var_dump($this->redis->srem('set_books', 'php'));
        var_dump($this->redis->smembers('set_books'));
        var_dump($this->redis->spop('set_books'));
        var_dump($this->redis->smembers('set_books'));

        echo "-------------\n";

        // # zset
        $this->redis->zadd('zset_books', [
            'think in java' => 9.0,
            'java concurrency' => 8.9,
            'java cookbook' => 8.6,
        ]);
        var_dump($this->redis->zrange('zset_books', 0, -1));
        var_dump($this->redis->zrevrange('zset_books', 0, -1));
        var_dump($this->redis->zscore('zset_books', 'java concurrency'));
        var_dump($this->redis->zrank('zset_books', 'think in java'));
        var_dump($this->redis->zrangebyscore('zset_books', '-inf', 8.91, ['withscores' => true]));
    }
}