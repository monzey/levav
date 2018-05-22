<?php

namespace Levav\Controller;

use Phalcon\Mvc\Controller as BaseController;
use Phalcon\Mvc\Model;
use Tobscure\JsonApi\Document;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Resource;
use Tobscure\JsonApi\ErrorHandler;
use Tobscure\JsonApi\Exception\Handler\FallbackExceptionHandler;

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
        // @todo récupérer les relationships passées par la request (parameter included)

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

    public function patchAction(int $id)
    {
        $manager = new \Art4\JsonApiClient\Utils\Manager();
        // @todo handle validation errors
        $document = $manager->parse($this->request->getRawBody());
        $resource = $this->resource->getModel()::findFirst($id);

        // basic attributes
        foreach ($document->get('data')->get('attributes')->asArray(true) as $key => $value) {
            $resource->{$key} = $value;
        }

        // @todo handle saving errors
        $resource->save();

        return $this->renderSerialized($resource);
    }

    public function postAction()
    {
        $manager = new \Art4\JsonApiClient\Utils\Manager();
        $manager->setConfig('optional_item_id', true);
        // @todo handle validation errors
        $document = $manager->parse($this->request->getRawBody());
        $resource = $this->resource->getModel();

        // basic attributes
        foreach ($document->get('data')->get('attributes')->asArray(true) as $key => $value) {
            $resource->{$key} = $value;
        }

        // @todo handle saving errors
        $resource->save();

        return $this->renderSerialized($resource);
    }

    public function deleteAction(int $id)
    {
        $resource = $this->resource->getModel()::findFirst($id);
        $resource->delete();

        $this->response->setStatusCode(204);
        $this->response->send();
    }

    public function optionsAction()
    {
        return ['GET', 'POST', 'PATCH', 'DELETE'];
    }
}
