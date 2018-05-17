<?php

namespace Levav\Controller;

use Phalcon\Mvc\Controller as PhalconController;
use Tobscure\JsonApi\Document;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Resource;

use Levav\Model\SerializableInterface;

abstract class Controller extends PhalconController
{
    public $resourceName;

    protected function getModel()
    {
        $modelClassName = 'Levav\Model\\' . $this->resourceName;

        return new $modelClassName();
    }

    protected function renderSerialized($data)
    {
        $documentData;
        $serializer = $this->getModel()->getSerializer();
        $relationships = $serializer->getDefaultRelationships();
        // @todo récupérer les relationships passées par la request

        if ($data instanceof \ArrayAccess) {
            $documentData = new Collection($data, $serializer); 
        } elseif ($data instanceof SerializableInterface) {
            $documentData = new Resource($data, $serializer); 
        } else {
            return json_encode(new Document());
        }

        $documentData->with($relationships);

        return json_encode(new Document($documentData));
    }

    public function cGetAction()
    {
        $resources = $this->getModel()::find();

        return $this->renderSerialized($resources);
    }

    public function getAction(int $id)
    {
        $resource = $this->getModel()::findFirst($id);

        return $this->renderSerialized($resources);
    }

    public function putAction(int $id) 
    {
        // @todo update record

        $resource = $this->getModel()::findFirst($id);

        return json_encode(new Document(new Resource($resource, $this->getModel()->getSerializer())));
    }

    public function patchAction(int $id)
    {
        // @todo update record

        $resource = $this->getModel()::findFirst($id);

        return json_encode(new Document(new Resource($resource, $this->getModel()->getSerializer())));
    }

    public function postAction()
    {

    }

    public function deleteAction(int $id)
    {

    }

    public function optionsAction()
    {
        return ['GET', 'POST', 'PATCH', 'PUT', 'DELETE'];
    }
}
