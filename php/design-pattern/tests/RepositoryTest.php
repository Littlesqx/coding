<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Tests;

use DesignPattern\Other\Repository\MemoryStorage;
use DesignPattern\Other\Repository\Post;
use DesignPattern\Other\Repository\PostRepository;
use PHPUnit\Framework\TestCase;

class RepositoryTest extends TestCase
{
    public function testCanPersistAndFindPost()
    {
        $repository = new PostRepository(new MemoryStorage());
        $post = new Post(null, 'Repository Pattern', 'Design Patterns PHP');
        $repository->save($post);

        $this->assertEquals(1, $post->getId());
        $this->assertEquals($post->getId(), $repository->findById(1)->getId());
    }
}