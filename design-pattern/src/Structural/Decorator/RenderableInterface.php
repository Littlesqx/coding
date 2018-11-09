<?php
/**
 * Created by PhpStorm.
 * User: littlesqx
 * Date: 18-11-9
 * Time: 下午3:31
 */

namespace DesignPattern\Structural\Decorator;


interface RenderableInterface
{
    public function renderData(): string;
}