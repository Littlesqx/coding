<?php

/*
 * This file is part of the littlesqx/data-structure.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Littlesqx\DataStructure;

class Map
{
    /**
     * @var array
     */
    private $keys = [];

    /**
     * @var array
     */
    private $values = [];

    /**
     * @var array
     */
    private $keyValueMapping = [];

    /**
     * Get the size of the Map.
     *
     * @return int
     */
    public function size(): int
    {
        return count($this->keys);
    }

    /**
     * Add or update a new item in the Map.
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        if (!in_array($key, $this->keys, true)) {
            $this->keys[] = $key;
            $this->values[] = $value;
            $this->keyValueMapping[array_key_last($this->keys)] = array_key_last($this->values);
        } else {
            $valueIndex = $this->keyValueMapping[array_search($key, $this->keys, true)];
            $this->values[$valueIndex] = $value;
        }
    }

    /**
     * Get an item from the Map.
     *
     * @param $key
     *
     * @return mixed|null
     */
    public function get($key)
    {
        $keyIndex = array_search($key, $this->keys, true);
        if (false !== $keyIndex) {
            $valueIndex = $this->keyValueMapping[$keyIndex] ?? null;

            return false !== $valueIndex ? ($this->values[$valueIndex] ?? null) : null;
        }

        return null;
    }

    /**
     * Whether the item is exist in the map or not.
     *
     * @param $key
     *
     * @return bool
     */
    public function has($key)
    {
        return in_array($key, $this->keys, true);
    }

    /**
     * Remove an item from the map.
     *
     * @param $key
     *
     * @return bool
     */
    public function delete($key)
    {
        if ($this->has($key)) {
            $keyIndex = array_search($key, $this->values, true);
            $valueIndex = $this->keyValueMapping[$keyIndex];
            unset(
                $this->keys[$keyIndex],
                $this->values[$valueIndex],
                $this->keyValueMapping[$keyIndex]
            );

            return true;
        }

        return false;
    }

    /**
     * Clear the Map.
     */
    public function clear()
    {
        $this->keys = $this->values = $this->keyValueMapping = [];
    }

    /**
     * Get all keys from the Map.
     *
     * @return array
     */
    public function keys()
    {
        return $this->keys;
    }

    /**
     * Get all values from the values.
     *
     * @return array
     */
    public function values()
    {
        return $this->values;
    }

    /**
     * Traverse the map.
     *
     * @return \Generator
     */
    public function entries()
    {
        foreach ($this->keys as $key) {
            yield [$key, $this->get($key)];
        }
    }
}
