<?php

namespace Levav\Resource;

use Levav\Resource\Resource;

class Place extends Resource
{
    public function getName(): string
    {
        return 'place';
    }

    public function getPluralName(): string
    {
        return 'places';
    }
}
