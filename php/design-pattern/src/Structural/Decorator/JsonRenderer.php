<?php

/*
 * This file is part of the coding.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DesignPattern\Structural\Decorator;

class JsonRenderer extends RendererDecorator
{

    public function renderData(): string
    {
        return \json_encode($this->wrapped->renderData());
    }
}