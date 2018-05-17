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

    public function getAttributes($postalAddress, array $fields = null)
    {
        return [
            'streetAddress' => $postalAddress->getStreetAddress(),
            'addressCountry' => $postalAddress->getAddressCountry(),
            'addressLocality' => $postalAddress->getAddressLocality(),
            'addressRegion' => $postalAddress->getAddressRegion(),
            'postalCode' => $postalAddress->getPostalCode(),
            'postOfficeBoxNumber' => $postalAddress->getPostOfficeBoxNumber()
        ];
    }
}
