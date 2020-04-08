<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure\Problem\Heap;

use Littlesqx\DataStructure\Heap;
use Swoole\Coroutine;

final class Timer
{
    private $heap;

    private static $taskMap = [];

    private static $currentId = 0;

    /**
     * @var Timer
     */
    private static $timer;

    private function __clone()
    {
    }

    private function __construct()
    {
        $this->heap = new class() extends Heap {
            private $timeMap = [];

            public function insert($value): void
            {
                [$id, $time] = $value;
                $this->timeMap[$id] = $time;
                parent::insert($id);
            }

            public function extract()
            {
                if (parent::isEmpty()) {
                    return null;
                }
                $id = parent::top();
                $now = (int) (microtime(true) * 1000);
                if ($this->timeMap[$id] > $now) {
                    return null;
                }
                unset($this->timeMap[$id]);

                return parent::extract();
            }

            public function compare($firstValue, $secondValue): int
            {
                return $this->timeMap[$secondValue] <=> $this->timeMap[$firstValue];
            }
        };

        Coroutine::create(function () {
            while (true) {
                if ($id = $this->heap->extract()) {
                    if (is_callable($task = self::$taskMap[$id])) {
                        try {
                            $task();
                        } catch (\Throwable $t) {
                            trigger_error('Error when exec task: '.$t->getMessage());
                        } finally {
                            unset(self::$taskMap[$id]);
                        }
                    }
                }
                // Transfer executive power
                Coroutine::sleep(.001);
            }
        });
    }

    private static function getInstance()
    {
        if (null === self::$timer) {
            self::$timer = new self();
        }

        return self::$timer;
    }

    public static function tick(callable $callback, int $delay)
    {
        $id = ++self::$currentId;
        self::$taskMap[$id] = $callback;
        $executeTime = (int) (microtime(true) * 1000) + max($delay, 0);
        self::getInstance()->heap->insert([$id, $executeTime]);

        // register tick
        Coroutine::create(function () use ($executeTime, $callback, $delay) {
            $after = $executeTime - (int) ((microtime(true) * 1000));
            Coroutine::sleep(round($after / 1000 + 0.0005, 3));
            self::tick($callback, $delay);
        });

        return $id;
    }

    public static function after(callable $callback, int $delay)
    {
        $id = ++self::$currentId;
        self::$taskMap[$id] = $callback;
        self::getInstance()->heap->insert([$id, (int) (microtime(true) * 1000) + max($delay, 0)]);

        return $id;
    }
}
