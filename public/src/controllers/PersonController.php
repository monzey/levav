<?php

namespace Levav\Controller;

use Levav\Controller\Controller;
use Levav\Model\Person;

class PersonController extends Controller
{
    public function cGetAction()
    {
        return $this->serializer->serialize(Person::find());
    }

    public function getAction(int $id)
    {
        
    }

    public function putAction(int $id)
    {
        
    }

    public function patchAction(int $id)
    {
        
    }

    public function postAction()
    {
        var_dump($this->request);
    }

    public function deleteAction(int $id)
    {
        
    }
}
