<?php

namespace Levav;

use Phalcon\Mvc\Micro\Collection;

use Levav\Controller\PersonsController;

class Router
{
    /**
     * Constructor
     */
    public function __construct()
    {
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
        $persons = new Collection();

        $persons->setHandler(new PersonsController());
        $persons->setPrefix('/persons');

        $persons->get('/', 'cGetAction');
        $persons->get('/{id}', 'getAction');
        $persons->post('/', 'postAction');
        $persons->put('/{id}', 'putAction');
        $persons->patch('/{id}', 'patchAction');
        $persons->delete('/{id}', 'deleteAction');

        $this->addRouteCollection($persons);
    }
}
