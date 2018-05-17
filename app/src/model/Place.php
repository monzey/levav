<?php

namespace Levav\Model;

use Levav\Model\Thing;
use Levav\Model\PostalAddress;

class Place extends Thing
{
    protected $address;
    
    public function initialize()
    {
        $this->hasOne(
            'address',
            PostalAddress::class,
            'id',
            [ 'alias' => 'address' ]
        );
    }
}
