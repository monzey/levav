<?php

namespace Levav\Model\Serializer;

use Tobscure\JsonApi\AbstractSerializer;

class PersonSerializer extends AbstractSerializer
{
    protected $type = 'person';

    public function getAttributes($person, array $fields = null)
    {
        return [
            'familyName' => $person->getFamilyName(),
            'givenName' => $person->getGivenName(),
            'gender' => $person->getGender()
        ];
    }
}
