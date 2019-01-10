<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Structural\Registry;

abstract class Registry
{
    const LOGGER = 'logger';

    private static $storedValues = [];

    private static $allowedKeys = [self::LOGGER];

    public static function set(string $key, $value)
    {
        if (!in_array($key, self::$allowedKeys)) {
            throw new \InvalidArgumentException('Invalid key given');
        }
        self::$storedValues[$key] = $value;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public static function get(string $key)
    {
        if (!in_array($key, self::$allowedKeys)) {
            throw new \InvalidArgumentException('Invalid key given');
        }
        if (!isset(self::$storedValues[$key])) {
            throw new \InvalidArgumentException("StoredValues[{$key}] is not be set");
        }
        return self::$storedValues[$key];
    }
}