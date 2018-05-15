<?php

namespace Levav;

use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url;
use Phalcon\Config;

use Levav\ResourceRouter;

class App extends Micro 
{
    protected $di;

    /**
     * @param mixed 
     */
    public function __construct()
    {
        $this->registerDi();

        parent::__construct($this->di);

        $this->registerRoutes();
    }

    private function registerDi()
    {
        $this->di = new FactoryDefault();

        $this->di->set('url', function() {
            $url = new Url();
            $url->setBaseUri('/api');

            return $url;
        });

        $this->di->set('config', function() {
            $config = require 'config.php';

            return new Config($config);
        });
    }

    private function registerRoutes()
    {
        $router = new ResourceRouter();

        foreach ($router->getRoutes() as $collection) {
            $this->mount($collection);
        }

        // not found handler
        $self = $this;

        $this->notFound(function () use ($self) {
            $self->response->setStatusCode(404, 'Not Found');
            $self->response->sendHeaders();

            $self->response->setContent('Not Found');
            $self->response->send();
        });
    }
}
