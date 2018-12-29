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

class PostRepository
{
    /**
     * @var MemoryStorage
     */
    private $persistence;

    public function __construct(MemoryStorage $persistence)
    {
        $this->persistence = $persistence;
    }

    /**
     * @param int $id
     *
     * @return Post
     */
    public function findById(int $id): Post
    {
        $arrayData = $this->persistence->retrieve($id);
        if (is_null($arrayData)) {
            throw new \InvalidArgumentException(sprintf('Post with ID %d does not exist', $id));
        }
        return Post::fromState($arrayData);
    }

    /**
     * @param Post $post
     */
    public function save(Post $post)
    {
        $id = $this->persistence->persist([
            'text' => $post->getText(),
            'title' => $post->getTitle()
        ]);
        $post->setId($id);
    }
}