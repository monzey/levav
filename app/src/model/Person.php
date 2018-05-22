<?php

namespace Levav\Model;

use Levav\Model\Thing;
use Levav\Model\Place;

class Person extends Thing
{
    protected $familyName;
    protected $givenName;
    protected $gender;

    protected $emails;
    protected $telephones;
    public $homeLocation;

    public function onConstruct()
    {
        $this->emails = [];
        $this->telephones = [];
    }

    public function initialize()
    {
        $this->hasOne(
            'home_location',
            Place::class,
            'id',
            [ 'alias' => 'homeLocation' ]
        );
    }

    /**
     * Getter for telephones
     *
     * @return string
     */
    public function getTelephones()
    {
        return $this->telephones;
    }
    
    /**
     * Setter for telephones
     *
     * @param string $telephones
     * @return Person
     */
    public function setTelephones($telephones)
    {
        $this->telephones = $telephones;
    
        return $this;
    }

    /**
     * Getter for emails
     *
     * @return string
     */
    public function getEmails()
    {
        return $this->emails;
    }
    
    /**
     * Setter for emails
     *
     * @param string $emails
     * @return Person
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;
    
        return $this;
    }

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
