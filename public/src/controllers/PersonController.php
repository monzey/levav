<?php

namespace Levav\Controller;

use Levav\Controller\Controller;
use Levav\Model\Person;

class PersonController extends Controller
{
    public function cGetAction()
    {
        $persons = Person::find();

        $count = count($persons);

        return "${count} persons";
    }

    public function getAction()
    {
        
    }

    public function putAction()
    {
        
    }

    public function patchAction()
    {
        
    }

    public function postAction()
    {
        
    }

    public function deleteAction()
    {
        
    }
}
