<?php

namespace Levav\Controller;

use Phalcon\Mvc\Controller as PhalconController;

abstract class Controller extends PhalconController
{
    abstract public function cGetAction();
    abstract public function getAction(int $id);
    abstract public function putAction(int $id);
    abstract public function patchAction(int $id);
    abstract public function postAction();
    abstract public function deleteAction(int $id);

    public function optionsAction()
    {
        return ['GET', 'POST', 'PATCH', 'PUT', 'DELETE'];
    }
}
