<?php

namespace Levav\Resource;

abstract class Resource
{
    protected $model;
    protected $handler;

    abstract public function getName();
    abstract public function getPluralName();
}
