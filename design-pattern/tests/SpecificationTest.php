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


use DesignPattern\Behavioral\Specification\AndSpecification;
use DesignPattern\Behavioral\Specification\Item;
use DesignPattern\Behavioral\Specification\NotSpecification;
use DesignPattern\Behavioral\Specification\OrSpecification;
use DesignPattern\Behavioral\Specification\PriceSpecification;
use PHPUnit\Framework\TestCase;

class SpecificationTest extends TestCase
{
    public function testCanOr()
    {
        $spec1 = new PriceSpecification(50, 99);
        $spec2 = new PriceSpecification(100, 149);
        $orSpec = new OrSpecification($spec1, $spec2);

        $this->assertFalse($orSpec->isSatisfiedBy(new Item(49)));
        $this->assertTrue($orSpec->isSatisfiedBy(new Item(50)));
        $this->assertTrue($orSpec->isSatisfiedBy(new Item(100)));
    }

    public function testCanAnd()
    {
        $spec1 = new PriceSpecification(50, 99);
        $spec2 = new PriceSpecification(70, 119);
        $orSpec = new AndSpecification($spec1, $spec2);

        $this->assertFalse($orSpec->isSatisfiedBy(new Item(49)));
        $this->assertFalse($orSpec->isSatisfiedBy(new Item(50)));
        $this->assertFalse($orSpec->isSatisfiedBy(new Item(119)));
        $this->assertTrue($orSpec->isSatisfiedBy(new Item(70)));
        $this->assertTrue($orSpec->isSatisfiedBy(new Item(99)));
    }

    public function testCanNot()
    {
        $spec1 = new PriceSpecification(50, 100);
        $notSpec = new NotSpecification($spec1);

        $this->assertTrue($spec1->isSatisfiedBy(new Item(60)));
        $this->assertFalse($notSpec->isSatisfiedBy(new Item(60)));
    }
}