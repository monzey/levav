<?php

namespace Levav\Resource;

use Levav\Resource\Resource;

class Place extends Resource
{
    public function getName()
    {
        return 'place';
    }

    public function getPluralName()
    {
        return 'places';
    }
}
