<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Behavioral\Specification;


class PriceSpecification implements SpecificationInterface
{

    private $minPrice;

    private $maxPrice;

    public function __construct($minPrice, $maxPrice)
    {
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
    }

    public function isSatisfiedBy(Item $item): bool
    {
        if ($this->minPrice !== null && $item->getPrice() < $this->minPrice) {
            return false;
        }

        if ($this->maxPrice !== null && $item->getPrice() > $this->maxPrice) {
            return false;
        }

        return true;

    }
}