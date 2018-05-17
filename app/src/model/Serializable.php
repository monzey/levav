<?php

namespace Levav\Model;

use Phalcon\Mvc\Model;

/**
 * Represents a model serializable for json:api documents
 */
trait Serializable 
{
    public function getSerializer()
    {
        $serializerClassName = 'Levav\Model\Serializer\\' . (new \ReflectionClass($this))->getShortName() . 'Serializer';

        return new $serializerClassName();
    }

}
