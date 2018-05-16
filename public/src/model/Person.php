<?php

namespace Levav\Model;

use Levav\Model\Thing;

class Person extends Thing
{
    protected $familyName;
    protected $givenName;
    protected $gender;

    /**
     * Getter for gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }
    
    /**
     * Setter for gender
     *
     * @param string $gender
     * @return Person
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    
        return $this;
    }

    /**
     * Getter for givenName
     *
     * @return string
     */
    public function getGivenName()
    {
        return $this->givenName;
    }
    
    /**
     * Setter for givenName
     *
     * @param string $givenName
     * @return Person
     */
    public function setGivenName($givenName)
    {
        $this->givenName = $givenName;
    
        return $this;
    }

    /**
     * Getter for familyName
     *
     * @return string
     */
    public function getFamilyName()
    {
        return $this->familyName;
    }
    
    /**
     * Setter for familyName
     *
     * @param string $familyName
     * @return Person
     */
    public function setFamilyName($familyName)
    {
        $this->familyName = $familyName;
    
        return $this;
    }
}
