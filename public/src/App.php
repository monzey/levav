<?php

namespace Levav;

use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url;

use Levav\ResourceRouter;

class App extends Micro 
{
    /**
     * @param mixed 
     */
    public function __construct()
    {
        parent::__construct($this->configureDi());

        $this->registerRoutes();
    }

    private function configureDi()
    {
        $di = new FactoryDefault();

        $di->set('url', function() {
            $url = new Url();
            $url->setBaseUri('/api');

            return $url;
        });

        return $di;
    }

    private function registerRoutes()
    {
        $router = new ResourceRouter();

        foreach ($router->getRoutes() as $collection) {
            $this->mount($collection);
        }

        // not fond handler
        $self = $this;

        $this->notFound(function () use ($self) {
            $self->response->setStatusCode(404, 'Not Found');
            $self->response->sendHeaders();

            $self->response->setContent('Not Found');
            $self->response->send();
        });
    }
}
