<?php

namespace Levav\Model;

use Phalcon\Mvc\Model;
    
class Thing extends Model
{
    public function getSerializer()
    {
        $serializerClassName = 'Levav\Model\Serializer\\' . (new \ReflectionClass($this))->getShortName() . 'Serializer';

        return new $serializerClassName();
    }

    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $name;
}
