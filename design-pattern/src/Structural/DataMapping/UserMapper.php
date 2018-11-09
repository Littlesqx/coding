<?php

namespace DesignPattern\Structural\DataMapping;

class UserMapper
{
    /**
     * @var StorageAdapter
     */
    private $adapter;

    public function __construct(StorageAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id) : User
    {
        $data = $this->adapter->find($id);
        if (null === $data) {
            throw new \InvalidArgumentException("User #$id not found.");
        }
        return $this->mapRowToUser($data);
    }

    /**
     * @param array $row
     * @return User
     */
    private function mapRowToUser(array $row) : User
    {
        return User::fromState($row);
    }
}