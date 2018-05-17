<?php

namespace Levav\Controller;

use Phalcon\Mvc\Controller as BaseController;
use Phalcon\Mvc\Model;
use Tobscure\JsonApi\Document;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Resource;

abstract class Controller extends BaseController
{
    public $resource;

    /**
     * Setter for resourceClassName
     *
     * @param string $resourceClassName
     * @return Controller
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    
        return $this;
    }

    protected function renderSerialized($data)
    {
        $documentData;
        $serializer = $this->resource->getSerializer();
        $relationships = $serializer->getDefaultRelationships();
        // @todo récupérer les relationships passées par la request

        if ($data instanceof \ArrayAccess) {
            $documentData = new Collection($data, $serializer); 
        } elseif ($data instanceof Model) {
            $documentData = new Resource($data, $serializer); 
        } else {
            return json_encode(new Document(), JSON_PRETTY_PRINT);
        }

        $documentData->with($relationships);

        if ($json = json_encode(new Document($documentData))) {
            return $json;
        } else {
            throw new \Exception(sprintf('An error has occured during serialization : %s', json_last_error_msg()));
        }
    }

    public function cGetAction()
    {
        $resources = $this->resource->getModel()::find();

        return $this->renderSerialized($resources);
    }

    public function getAction(int $id)
    {
        $resource = $this->resource->getModel()::findFirst($id);

        return $this->renderSerialized($resource);
    }

    public function putAction(int $id) 
    {
        // @todo update record

        $resource = $this->getModel()::findFirst($id);

        return $this->renderSerialized($resource);
    }

    public function patchAction(int $id)
    {
        // @todo update record

        $resource = $this->getModel()::findFirst($id);

        return $this->renderSerialized($resource);
    }

    public function postAction()
    {
        $this->resource->bind($this->request);
        $this->resource->save();

        return $this->renderSerialized($this->resource->getModel());
    }

    public function deleteAction(int $id)
    {

    }

    public function optionsAction()
    {
        return ['GET', 'POST', 'PATCH', 'PUT', 'DELETE'];
    }
}
