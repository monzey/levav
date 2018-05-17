<?php

namespace Levav\Model\Serializer;

use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Relationship;

use Levav\Model\PostalAddress;
use Levav\Model\Serializer\AbstractSerializer;

class PersonSerializer extends AbstractSerializer
{
    protected $type = 'person';

    public function getDefaultRelationships(): array
    {
        return [ 'postalAddresses' ];
    }

    public function getAttributes($person, array $fields = null)
    {
        return [
            'familyName' => $person->getFamilyName(),
            'givenName' => $person->getGivenName(),
            'gender' => $person->getGender()
        ];
    }

    public function postalAddresses($person)
    {
        return new Relationship(new Collection($person->getPostalAddresses(), (new PostalAddress())->getSerializer()));
    }
}
