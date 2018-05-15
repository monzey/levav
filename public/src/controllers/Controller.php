<?php

namespace Levav\Controller;

use Phalcon\Mvc\Controller as PhalconController;

abstract class Controller extends PhalconController
{
    abstract public function cGetAction();
    abstract public function getAction();
    abstract public function putAction();
    abstract public function patchAction();
    abstract public function postAction();
    abstract public function deleteAction();

    public function optionsAction()
    {
        return ['GET', 'POST', 'PATCH', 'PUT', 'DELETE'];
    }
}
