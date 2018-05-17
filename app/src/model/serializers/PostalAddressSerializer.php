<?php

namespace Levav\Model\Serializer;

use Levav\Model\Serializer\AbstractSerializer;

class PostalAddressSerializer extends AbstractSerializer
{
    protected $type = 'postal_address';

    public function getDefaultRelationships(): array
    {
        return [];
    }

    public function getAttributes($person, array $fields = null)
    {
        return [
            'streetAddress' => $person->getStreetAddress(),
            'addressCountry' => $person->getAddressCountry(),
            'addressLocality' => $person->getAddressLocality(),
            'addressRegion' => $person->getAddressRegion(),
            'postalCode' => $person->getPostalCode(),
            'postOfficeBoxNumber' => $person->getPostOfficeBoxNumber()
        ];
    }
}
