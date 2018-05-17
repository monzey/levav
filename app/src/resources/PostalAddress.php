<?php

namespace Levav\Resource;

use Levav\Resource\Resource;

class PostalAddress extends Resource
{
    public function getName(): string
    {
        return 'postalAddress';
    }

    public function getPluralName(): string
    {
        return 'postalAddresses';
    }
}
