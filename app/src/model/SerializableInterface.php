<?php

namespace Levav\Model;

use Levav\Model\Serializer\AbstractSerializer as Serializer;

interface SerializableInterface
{
    public static function createSerializer(): Serializer;
}
