<?php

namespace LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Address
 *
 * @ORM\Table(name="location")
 * @ORM\Entity()
 */
class Location
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="street_number", type="string", length=10, nullable=true)
     */
    private $streetNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", length=100, nullable=true)
     * 
     */
    private $route;

    /**
     * @var string
     *
     * @ORM\Column(name="locality", type="string", length=100, nullable=true)
     * @Assert\NotBlank(message="La ville n'est pas indiquée")
     */
    private $locality;

    /**
     * @var string
     *
     * @ORM\Column(name="adm_area_level_1", type="string", length=100, nullable=true)
     */
    private $admAreaLevel1;

    /**
     * @var string
     *
     * @ORM\Column(name="adm_area_level_2", type="string", length=100, nullable=true)
     */
    private $admAreaLevel2;

    /**
     * @var string
     *
     * @ORM\Column(name="adm_area_level_3", type="string", length=100, nullable=true)
     */
    private $admAreaLevel3;

    /**
     * @var string
     *
     * @ORM\Column(name="adm_area_level_4", type="string", length=100, nullable=true)
     */
    private $admAreaLevel4;

    /**
     * @var string
     *
     * @ORM\Column(name="adm_area_level_5", type="string", length=100, nullable=true)
     */
    private $admAreaLevel5;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=100, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=10, nullable=true)
     * 
     */
    private $postalCode;

    /**
     * @var float
     *
     * @ORM\Column(name="lat", type="float", nullable=true)
     */
    private $lat;

    /**
     * @var float
     *
     * @ORM\Column(name="lng", type="float", nullable=true)
     */
    private $lng;


    /**
     * @var string
     *
     * @ORM\Column(name="formatted_address", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $formattedAddress;    


    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100, nullable=true)
     */
    private $type;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set streetNumber
     *
     * @param string $streetNumber
     * @return Address
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    /**
     * Get streetNumber
     *
     * @return string 
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * Set route
     *
     * @param string $route
     * @return Address
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string 
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set locality
     *
     * @param string $locality
     * @return Address
     */
    public function setLocality($locality)
    {
        $this->locality = $locality;

        return $this;
    }

    /**
     * Get locality
     *
     * @return string 
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * Set admAreaLevel1
     *
     * @param string $admAreaLevel1
     * @return Address
     */
    public function setAdmAreaLevel1($admAreaLevel1)
    {
        $this->admAreaLevel1 = $admAreaLevel1;

        return $this;
    }

    /**
     * Get admAreaLevel1
     *
     * @return string 
     */
    public function getAdmAreaLevel1()
    {
        return $this->admAreaLevel1;
    }

    /**
     * Set admAreaLevel2
     *
     * @param string $admAreaLevel2
     * @return Address
     */
    public function setAdmAreaLevel2($admAreaLevel2)
    {
        $this->admAreaLevel2 = $admAreaLevel2;

        return $this;
    }

    /**
     * Get admAreaLevel2
     *
     * @return string 
     */
    public function getAdmAreaLevel2()
    {
        return $this->admAreaLevel2;
    }

    /**
     * Set admAreaLevel3
     *
     * @param string $admAreaLevel3
     * @return Address
     */
    public function setAdmAreaLevel3($admAreaLevel3)
    {
        $this->admAreaLevel3 = $admAreaLevel3;

        return $this;
    }

    /**
     * Get admAreaLevel3
     *
     * @return string 
     */
    public function getAdmAreaLevel3()
    {
        return $this->admAreaLevel3;
    }

    /**
     * Set admAreaLevel4
     *
     * @param string $admAreaLevel4
     * @return Address
     */
    public function setAdmAreaLevel4($admAreaLevel4)
    {
        $this->admAreaLevel4 = $admAreaLevel4;

        return $this;
    }

    /**
     * Get admAreaLevel4
     *
     * @return string 
     */
    public function getAdmAreaLevel4()
    {
        return $this->admAreaLevel4;
    }

    /**
     * Set admAreaLevel5
     *
     * @param string $admAreaLevel5
     * @return Address
     */
    public function setAdmAreaLevel5($admAreaLevel5)
    {
        $this->admAreaLevel5 = $admAreaLevel5;

        return $this;
    }

    /**
     * Get admAreaLevel5
     *
     * @return string 
     */
    public function getAdmAreaLevel5()
    {
        return $this->admAreaLevel5;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Address
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     * @return Address
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set lat
     *
     * @param float $lat
     * @return Address
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return float 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param float $lng
     * @return Address
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return float 
     */
    public function getLng()
    {
        return $this->lng;
    }

    public function __toString()
    {
        return $this->getStreetNumber() . ' ' . $this->getRoute() . ' ' . $this->getLocality(); 
    }


    /**
     * Set formattedAddress
     *
     * @param string $formattedAddress
     * @return Address
     */
    public function setFormattedAddress($formattedAddress)
    {
        $this->formattedAddress = $formattedAddress;

        return $this;
    }

    /**
     * Get formattedAddress
     *
     * @return string 
     */
    public function getFormattedAddress()
    {
        return $this->formattedAddress;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Address
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
}
