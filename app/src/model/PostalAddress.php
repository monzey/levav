<?php

namespace Levav\Model;

use Levav\Model\Thing;

class PostalAddress extends Thing
{
    protected $addressCountry;
    protected $addressLocality;
    protected $addressRegion;
    protected $postalCode;
    protected $streetAddress;
    protected $postOfficeBoxNumber;

    /**
     * Getter for addressCountry
     *
     * @return string
     */
    public function getAddressCountry()
    {
        return $this->addressCountry;
    }
    
    /**
     * Setter for addressCountry
     *
     * @param string $addressCountry
     * @return PostalAddress
     */
    public function setAddressCountry($addressCountry)
    {
        $this->addressCountry = $addressCountry;
    
        return $this;
    }

    /**
     * Getter for addressLocality
     *
     * @return string
     */
    public function getAddressLocality()
    {
        return $this->addressLocality;
    }
    
    /**
     * Setter for addressLocality
     *
     * @param string $addressLocality
     * @return PostalAddress
     */
    public function setAddressLocality($addressLocality)
    {
        $this->addressLocality = $addressLocality;
    
        return $this;
    }

    /**
     * Getter for addressRegion
     *
     * @return string
     */
    public function getAddressRegion()
    {
        return $this->addressRegion;
    }
    
    /**
     * Setter for addressRegion
     *
     * @param string $addressRegion
     * @return PostalAddress
     */
    public function setAddressRegion($addressRegion)
    {
        $this->addressRegion = $addressRegion;
    
        return $this;
    }

    /**
     * Getter for postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }
    
    /**
     * Setter for postalCode
     *
     * @param string $postalCode
     * @return PostalAddress
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    
        return $this;
    }

    /**
     * Getter for streetAddress
     *
     * @return string
     */
    public function getStreetAddress()
    {
        return $this->streetAddress;
    }
    
    /**
     * Setter for streetAddress
     *
     * @param string $streetAddress
     * @return PostalAddress
     */
    public function setStreetAddress($streetAddress)
    {
        $this->streetAddress = $streetAddress;
    
        return $this;
    }

    /**
     * Getter for postOfficeBoxNumber
     *
     * @return string
     */
    public function getPostOfficeBoxNumber()
    {
        return $this->postOfficeBoxNumber;
    }
    
    /**
     * Setter for postOfficeBoxNumber
     *
     * @param string $postOfficeBoxNumber
     * @return PostalAddress
     */
    public function setPostOfficeBoxNumber($postOfficeBoxNumber)
    {
        $this->postOfficeBoxNumber = $postOfficeBoxNumber;
    
        return $this;
    }
}
