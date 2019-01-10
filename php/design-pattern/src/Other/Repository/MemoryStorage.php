<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Other\Repository;


class MemoryStorage
{
    private $data = [];

    private $lastId = 0;

    /**
     * @param array $data
     *
     * @return int
     */
    public function persist(array $data): int
    {
        $this->lastId++;
        $data['id'] = $this->lastId;
        $this->data[$this->lastId] = $data;

        return $this->lastId;
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function retrieve(int $id): array
    {
        if (!isset($this->data[$id])) {
            throw new \OutOfRangeException(sprintf('No data found for ID %d', $id));
        }
        return $this->data[$id];
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        if (!isset($this->data[$id])) {
            throw new \OutOfRangeException('No data found for ID %d', $id);
        }
        unset($this->data[$id]);
    }
}