<?php

namespace DesignPattern\Tests;

use DesignPattern\Structural\DataMapping\StorageAdapter;
use DesignPattern\Structural\DataMapping\User;
use DesignPattern\Structural\DataMapping\UserMapper;
use PHPUnit\Framework\TestCase;

class DataMapperTest extends TestCase
{
    public function testCanMapUserFromStorage()
    {
        $storage = new StorageAdapter([
            1 => [
                'username' => 'Littlesqx',
                'email' => 'Littlesqx@gmail.com'
            ]
        ]);
        $mapper = new UserMapper($storage);
        $user = $mapper->findById(1);
        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWillNotMapInvalidData()
    {
        $storage = new StorageAdapter([]);
        $mapper = new UserMapper($storage);

        $mapper->findById(1);
    }
}