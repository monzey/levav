<?php

namespace Levav;

use Phalcon\Mvc\Micro\Collection;

use Levav\Controller\PersonsController;
use Levav\Resource\Resource;

/**
 * Loads routes based on resources defined by Levav\Resource\Resource
 */
class ResourceRouter
{
    protected $routesCollections;
    protected $resources;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->registerResources();
        $this->registerRoutesCollections();
    }
    
    public function getRoutes()
    {
        return $this->routesCollections;
    }

    private function addRouteCollection(Collection $collection)
    {
        $this->routesCollections[] = $collection;
    }

    private function addResource(Resource $resource)
    {
        $this->resources[] = $collection;
    }

    private function registerRoutesCollections()
    {
        foreach ($this->resources as $resource) {
            $collection = new Collection();
            $resourcePluralName = $resource->getPluralName();
            $resourceName = $resource->getName();

            $controllerName = 'Levav\Controller\\' . ucfirst($resourceName) . 'Controller';

            $controller = new $controllerName();
            $controller->resourceName = ucfirst($resourceName);

            $collection->setHandler($controller);
            $collection->setPrefix("/{$resourcePluralName}");

            $collection->get('/', 'cGetAction');
            $collection->get('/{id}', 'getAction');
            $collection->post('/', 'postAction');
            $collection->put('/{id}', 'putAction');
            $collection->patch('/{id}', 'patchAction');
            $collection->delete('/{id}', 'deleteAction');

            $this->addRouteCollection($collection);
        }
    }

    private function registerResources()
    {
        $this->resources = [
            new \Levav\Resource\Person(),
            new \Levav\Resource\Place(),
        ];
    }
}
