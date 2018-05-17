<?php

namespace Levav\Controller;

use Phalcon\Mvc\Controller as PhalconController;
use Tobscure\JsonApi\Document;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Resource;

abstract class Controller extends PhalconController
{
    public $resourceName;

    private function getModel()
    {
        $modelClassName = 'Levav\Model\\' . $this->resourceName;

        return new $modelClassName();
    }

    public function cGetAction()
    {
        $resources = $this->getModel()::find();

        return json_encode(new Document(new Collection($resources, $this->getModel()->getSerializer())));
    }

    public function getAction(int $id)
    {
        $resource = $this->getModel()::findFirst($id);

        return json_encode(new Document(new Resource($resource, $this->getModel()->getSerializer())));
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
