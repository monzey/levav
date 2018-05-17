<?php

namespace Levav\Resource;

use Levav\Model\Person as PersonModel;
use Levav\Resource\Resource;

class Person extends Resource
{
    public function getName()
    {
        return 'person';
    }

    public function getPluralName()
    {
        return 'persons';
    }
}
