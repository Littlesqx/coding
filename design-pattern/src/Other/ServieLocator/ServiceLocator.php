<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Other\ServieLocator;


class ServiceLocator
{
    private $services = [];

    private $instantiated = [];

    private $shared = [];

    /**
     * @param string $class
     * @param $service
     * @param bool $share
     */
    public function addInstance(string $class, $service, bool  $share = true)
    {
        $this->services[$class] = $service;
        $this->instantiated[$class] = $service;
        $this->shared[$class] = $share;
    }

    public function addClass(string $class, array $params, bool $share = true)
    {
        $this->services[$class] = $params;
        $this->shared[$class] = $share;
    }

    public function has(string $interface)
    {
        return isset($this->services[$interface]) || isset($this->instantiated[$interface]);
    }

    public function get(string $class)
    {
        if (isset($this->instantiated[$class]) && $this->shared[$class]) {
            return $this->instantiated[$class];
        }
        $args = $this->services[$class];

        switch (count($args)) {
            case 0:
                $object = new $class();
                break;
            case 1:
                $object = new $class($args[0]);
                break;
            case 2:
                $object = new $class($args[0], $args[1]);
                break;
            case 3:
                $object = new $class($args[0], $args[1], $args[2]);
                break;
            default:
                throw new \OutOfRangeException('Too many arguments given');
        }

        if ($this->shared[$class]) {
            $this->instantiated[$class] = $object;
        }

        return $object;
    }
}