<?php

namespace DesignPattern\Structural\DataMapping;

class StorageAdapter
{
    /**
     * @var array
     */
    private $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function find(int $id) : ?array
    {
        if (isset($this->data[$id])) {
            return $this->data[$id];
        }
        return null;
    }
}