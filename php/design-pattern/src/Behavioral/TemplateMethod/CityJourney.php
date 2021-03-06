<?php

/*
 * This file is part of the design-pattern.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Behavioral\TemplateMethod;


class CityJourney extends Journey
{

    protected function enjoyVacation(): string
    {
        return 'Eat, drink, take photos and sleep';
    }

    protected function buyGift()
    {
        return 'Buy a gift';
    }
}