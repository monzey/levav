<?php

namespace Levav;

use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url;

class App extends Micro 
{
    /**
     * @param mixed 
     */
    public function __construct()
    {
        parent::__construct($this->configureDi());

        $this->configureRoutes();
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

    private function configureRoutes()
    {
        $this->get(
          '/members',
          function () {
            echo("home");
          }
        );

        $this->notFound(function () {
          echo 'Not found.';
        });
    }
}
