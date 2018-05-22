<?php

namespace Levav;

use Phalcon\Mvc\Micro\Collection;

use Levav\Controller\PersonsController;
use Levav\Resource\Resource;
use Levav\Resource\ResourceContainer;

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
    public function __construct(ResourceContainer $resources)
    {
        $this->resources = $resources;

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

    private function registerRoutesCollections()
    {
        foreach ($this->resources as $resource) {
            $collection         = new Collection();
            $resourcePluralName = $resource->getPluralName();
            $resourceName       = $resource->getName();

            $controllerName = 'Levav\Controller\\' . (new \ReflectionClass($resource))->getShortName() . 'Controller';

            $controller = new $controllerName();
            $controller->setResource($resource);

            $collection->setHandler($controller);
            $collection->setPrefix("/{$resourcePluralName}");

            $collection->get('/', 'cGetAction');
            $collection->get('/{id}', 'getAction');
            $collection->post('/', 'postAction');
            $collection->patch('/{id}', 'patchAction');
            $collection->delete('/{id}', 'deleteAction');

            $this->addRouteCollection($collection);
        }
    }
}
