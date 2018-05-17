<?php

namespace Levav\Resource;

use Phalcon\Mvc\Model;
use Phalcon\Http\Request;

use Levav\Model\Serializer\AbstractSerializer as Serializer;

abstract class Resource
{
    protected $model;
    protected $serializer;

    abstract public function getName(): string;
    abstract public function getPluralName(): string;

    public function getModelClassName(): string
    {
        return 'Levav\Model\\' . ucfirst((new \ReflectionClass($this))->getShortName());
    }

    public function getSerializerClassName(): string
    {
        return 'Levav\Model\Serializer\\' . ucfirst((new \ReflectionClass($this))->getShortName()) . 'Serializer';
    }

    public function __construct()
    {
        $serializerClassName = self::getSerializerClassName();
        $modelClassName = self::getModelClassName();

        $this->serializer = new $serializerClassName();
        $this->model = new $modelClassName();
    }
    
    public function getModel(): Model
    {
        return $this->model;
    }

    public function getSerializer(): Serializer
    {
        return $this->serializer;
    }

    public function bind(Request $request)
    {
        $fields = $request->getJsonRawBody();

        var_dump($fields);

        foreach ($fields as $field => $value) {
            $method = 'set' . ucfirst($field);

            if (is_callable([$this->model, $method], true)) {
                $this->model->$method($value);
            }
        }
    }

    public function save()
    {
        return $this->model->save();
    }
}
