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

    /**
     * Getter for name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Setter for name
     *
     * @param string $name
     * @return Thing
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Getter for description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Setter for description
     *
     * @param string $description
     * @return Thing
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }
}
