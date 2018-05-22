<?php

namespace Levav\Model\Serializer;

use Tobscure\JsonApi\Resource;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Relationship;

use Levav\Resource\Place;
use Levav\Model\Serializer\AbstractSerializer;

class PersonSerializer extends AbstractSerializer
{
    protected $type = 'person';

    public function getDefaultRelationships(): array
    {
        return [ 'homeLocation', 'homeLocation.address' ];
    }

    public function getAttributes($person, array $fields = null)
    {
        return [
            'familyName' => $person->getFamilyName(),
            'givenName'  => $person->getGivenName(),
            'gender'     => $person->getGender()
        ];
    }

    public function homeLocation($person)
    {
        return new Relationship(new Resource($person->getHomeLocation(), (new Place())->getSerializer()));
    }
}
