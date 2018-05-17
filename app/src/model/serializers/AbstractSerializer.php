<?php

namespace Levav\Model\Serializer;

use Tobscure\JsonApi\AbstractSerializer as BaseAbstractSerializer;

abstract class AbstractSerializer extends BaseAbstractSerializer
{
    abstract public function getDefaultRelationships(): array;
}
