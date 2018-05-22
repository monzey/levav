<?php

namespace Levav\Controller;

use Phalcon\Mvc\Controller as BaseController;
use Phalcon\Mvc\Model;
use Tobscure\JsonApi\Document;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Resource;
use Tobscure\JsonApi\ErrorHandler;
use Tobscure\JsonApi\Exception\Handler\FallbackExceptionHandler;

use Levav\Resource\Resource as LevavResource;

abstract class Controller extends BaseController
{
    public $resource;

    /**
     * Setter for resource
     *
     * @param Resource $resource
     * @return Controller
     */
    public function setResource(LevavResource $resource): Controller
    {
        $this->resource = $resource;
    
        return $this;
    }

    /**
     * Serializes data to match json:api specs
     *
     * @param mixed $data
     */
    protected function renderSerialized($data): string
    {
        $documentData;

        $serializer    = $this->resource->getSerializer();
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

    /**
     * Returns all of the resources based on uri type
     *
     * @return Response|string|null
     */
    public function cGetAction()
    {
        $resources = $this->resource->getModel()::find();

        return $this->renderSerialized($resources);
    }

    /**
     * Returns the resource for the id $id specified in uri
     *
     * @param int $id
     *
     * @return Response|string|null
     */
    public function getAction(int $id)
    {
        $resource = $this->resource->getModel()::findFirst($id);

        return $this->renderSerialized($resource);
    }

    /**
     * Partially updates the resource for the id $id specified in uri
     *
     * @param int $id
     *
     * @return Response|string|null
     */
    public function patchAction(int $id)
    {
        $manager = new \Art4\JsonApiClient\Utils\Manager();
        // @todo handle validation errors
        $document = $manager->parse($this->request->getRawBody());
        $resource = $this->resource->getModel()::findFirst($id);

        // basic attributes
        if ($document->get('data')->has('attributes')) {

            foreach ($document->get('data')->get('attributes')->asArray(true) as $key => $value) {
                $resource->{$key} = $value;
            }
        }

        if ($document->get('data')->has('relationships')) {

            foreach ($document->get('data')->get('relationships')->asArray() as $property => $relationship) {
                $relatedResource = $this->di->get('resources')[$relationship->get('data')->get('type')];
                $related         = $relatedResource->getModel()::findFirst($relationship->get('data')->get('id'));

                $resource->{$property} = $related;
            }
        }

        // @todo handle saving errors
        $resource->update();

        return $this->renderSerialized($resource);
    }

    /**
     * Creates a resource from request payload
     *
     * @return Response|string|null
     */
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

    /**
     * Deletes the resource of id $id specified in uri
     *
     * @param int $id
     *
     * @return Response|string|null
     */
    public function deleteAction(int $id)
    {
        $resource = $this->resource->getModel()::findFirst($id);
        $resource->delete();

        $this->response->setStatusCode(204);
        $this->response->send();
    }

    /**
     * Returns all of the actions that can be done for the uri
     *
     * @return Response|string|null
     */
    public function optionsAction()
    {
        return ['GET', 'POST', 'PATCH', 'DELETE'];
    }
}
