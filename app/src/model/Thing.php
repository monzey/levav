<?php

namespace Levav\Model;

use Phalcon\Mvc\Model;
    
class Thing extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $name;
}
