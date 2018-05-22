<?php

namespace Levav;

use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault as DiFactory;
use Phalcon\Mvc\Url;
use Phalcon\Config;
use Phalcon\Db\Adapter\Pdo\Factory as PdoFactory;

use Levav\ResourceRouter;
use Levav\Resource\ResourceContainer;
use Levav\Serializer;

class Kernel extends Micro 
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
        $self = $this;

        $this->di = new DiFactory;

        $this->di->set('url', function() {
            $url = new Url;
            $url->setBaseUri('/api');

            return $url;
        });

        $this->di->set('config', function() {
            return new Config(require __DIR__ . '/../config.php');
        });

        $this->di->set('db', function() use ($self) {
            return PdoFactory::load($self->di->get('config')->database);
        });

        $this->di->set('resources', function() {
            return new ResourceContainer();
        });
    }

    private function registerRoutes()
    {
        $router = new ResourceRouter($this->di->get('resources'));

        foreach ($router->getRoutes() as $collection) {
            $this->mount($collection);
        }

        // not found handler
        $self = $this;

        $this->notFound(function () use ($self) {
            $self->response->setStatusCode(404);
            $self->response->sendHeaders();

            $self->response->setContent('Not Found');
            $self->response->send();
        });
    }
}
