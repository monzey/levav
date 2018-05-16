<?php

namespace Levav;

use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\ResourceObject;
use JsonApiPhp\JsonApi\ResourceIdentifier;
use JsonApiPhp\JsonApi\Attribute;

use Levav\Model\Thing;

class Serializer
{
    public function serialize($data)
    {
        return json_encode(
            new DataDocument(
                new ResourceObject(
                    'bonsoir',
                    '1'
                )
            )
        );
    }
}
