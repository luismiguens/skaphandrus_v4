<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkPhotoSpeciesSugestion
 */
class SkPhotoSpeciesSugestion
{
    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $fosUser;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkSpecies
     */
    private $species;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhoto
     */
    private $photo;


    /**
     * Constructor
     */
    public function __construct() {
        $this->createdAt = new \DateTime();
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkPhotoSpeciesSugestion
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * Set fosUser
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $fosUser
     *
     * @return SkPhotoSpeciesSugestion
     */
    public function setFosUser(\Skaphandrus\AppBundle\Entity\FosUser $fosUser = null)
    {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \Skaphandrus\AppBundle\Entity\FosUser
     */
    public function getFosUser()
    {
        return $this->fosUser;
    }

    /**
     * Set species
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpecies $species
     *
     * @return SkPhotoSpeciesSugestion
     */
    public function setSpecies(\Skaphandrus\AppBundle\Entity\SkSpecies $species = null)
    {
        $this->species = $species;

        return $this;
    }

    /**
     * Get species
     *
     * @return \Skaphandrus\AppBundle\Entity\SkSpecies
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * Set photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $photo
     *
     * @return SkPhotoSpeciesSugestion
     */
    public function setPhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhoto
     */
    public function getPhoto()
    {
        return $this->photo;
    }
    
    
    
    
        public function doStuffOnPostPersist() {
    
            $em = $this->getDoctrine()->getManager();
            
            
         //enviar notificação de sugestão para o dono fotografia 
         //(x sugeriu especie y na tua fotografia z ) message_abc
            $SkSocialNotify = new SkSocialNotify();
            $SkSocialNotify->setUserFrom($this->getFosUser());
            $SkSocialNotify->setParamFirst($this->getSpecies()->getId());
            $SkSocialNotify->setParamSecond($this->getPhoto()->getId());
            $SkSocialNotify->setMessageName("message_abc");
            $SkSocialNotify->setCreatedAt(new \DateTime());
            $SkSocialNotify->setUserTo($this->getPhoto()->getFosUser());
            $em->persist($SkSocialNotify);
            
            
            
            
            
            //enviar notificação para quem já sugeriu 
            //(x sugeriu especie y na fotografia z) message_aba
//            
//            foreach ($array as $key => $value) {
//                
//            }
            
            
            
            
            $em->flush();
                    
            
            
            
            
        
    }

    
    
    
}

