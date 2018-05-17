<?php

namespace Levav\Model\Serializer;

use Tobscure\JsonApi\Resource;
use Tobscure\JsonApi\Relationship;

use Levav\Model\Serializer\AbstractSerializer;
use Levav\Model\PostalAddress;

class PlaceSerializer extends AbstractSerializer
{
    protected $type = 'place';

    public function getDefaultRelationships(): array
    {
        return [ 'address' ];
    }

    public function getAttributes($place, array $fields = null)
    {
        return [];
    }

    public function address($place)
    {
        return new Relationship(new Resource($place->getAddress(), (new PostalAddress())->getSerializer()));
    }
}
