<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure;

class HashTable
{
    protected $table;

    public function __construct()
    {
        $this->table = new Map();
    }

    protected function hash(string $key)
    {
        return md5($key);
    }

    public function put(string $key, $value)
    {
        $hash = $this->hash($key);

        $this->table->set($hash, $value);
    }

    public function remove(string $key)
    {
        $hash = $this->hash($key);

        $this->table->delete($hash);
    }

    public function get(string $key)
    {
        $hash = $this->hash($key);

        return $this->table->get($hash);
    }

    public function has(string $key)
    {
        $hash = $this->hash($key);

        return $this->table->has($hash);
    }

    public function size()
    {
        return $this->table->size();
    }
}
