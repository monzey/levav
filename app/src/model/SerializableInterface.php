<?php

namespace Levav\Model;

use Levav\Model\Serializer\AbstractSerializer as Serializer;

interface SerializableInterface
{
    public function getSerializer(): Serializer;
}
