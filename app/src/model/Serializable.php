<?php

namespace Levav\Model;

use Phalcon\Mvc\Model;

use Levav\Model\Serializer\AbstractSerializer as Serializer;

/**
 * Represents a model serializable for json:api documents
 */
trait Serializable 
{
    public function getSerializer(): Serializer
    {
        $serializerClassName = 'Levav\Model\Serializer\\' . (new \ReflectionClass($this))->getShortName() . 'Serializer';

        return new $serializerClassName();
    }

}
