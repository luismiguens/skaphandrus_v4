<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\Intl\Intl;

/**
 * SkCountry
 */
class SkCountry
{

    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $fipsCode;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkContinent
     */
    private $continent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $regions;

    private $photosCount = 0;

    private $spotsCount = 0;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->regions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setId($param) {
        $this->id = $param;
    }
    
    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkCountry
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set fipsCode
     *
     * @param string $fipsCode
     *
     * @return SkCountry
     */
    public function setFipsCode($fipsCode)
    {
        $this->fipsCode = $fipsCode;

        return $this;
    }

    /**
     * Get fipsCode
     *
     * @return string
     */
    public function getFipsCode()
    {
        return $this->fipsCode;
    }

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
     * Set continent
     *
     * @param \Skaphandrus\AppBundle\Entity\SkContinent $continent
     *
     * @return SkCountry
     */
    public function setContinent(\Skaphandrus\AppBundle\Entity\SkContinent $continent = null)
    {
        $this->continent = $continent;

        return $this;
    }

    /**
     * Get continent
     *
     * @return \Skaphandrus\AppBundle\Entity\SkContinent
     */
    public function getContinent()
    {
        return $this->continent;
    }

    /**
     * Add region
     *
     * @param \Skaphandrus\AppBundle\Entity\SkRegion $region
     *
     * @return SkCountry
     */
    public function addRegion(\Skaphandrus\AppBundle\Entity\SkRegion $region)
    {
        $this->regions[] = $region;

        return $this;
    }

    /**
     * Remove region
     *
     * @param \Skaphandrus\AppBundle\Entity\SkRegion $region
     */
    public function removeRegion(\Skaphandrus\AppBundle\Entity\SkRegion $region)
    {
        $this->regions->removeElement($region);
    }

    /**
     * Get regions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRegions()
    {
        return $this->regions;
    }
    
    
    public function __toString() {
        $name = Intl::getRegionBundle()->getCountryName($this->name);

        if ($this->name == 'AN') {
            $name = 'Netherlands Antilles';
        }

        return $name ? $name : '';
    }

    public function getSpotsCount() {
        return $this->spotsCount;
    }

    public function setSpotsCount($spotsCount) {
        $this->spotsCount = $spotsCount;
    }

    public function getPhotosCount() {
        return $this->photosCount;
    }

    public function setPhotosCount($photosCount) {
        $this->photosCount = $photosCount;
    }
    
    
     public function getSpots() {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT s 
                FROM SkaphandrusAppBundle:SkSpot s
                JOIN s.location l
                JOIN l.region r
                JOIN r.country c
                WHERE c.id = :country_id'
            )->setParameter('country_id', $this->getId())->getResult();
    }
    
    
}
