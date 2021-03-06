<?php

namespace Levav\Resource;

use Levav\Resource\Resource;

class Person extends Resource
{
    public function getName(): string
    {
        return 'person';
    }

    public function getPluralName(): string
    {
        return 'persons';
    }
}
