<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkSpeciesImageRef
 */
class SkSpeciesImageRef
{
    /**
     * @var boolean
     */
    private $isActive = '1';

    /**
     * @var boolean
     */
    private $isPrimary = '0';

    /**
     * @var string
     */
    private $imageUrl;

    /**
     * @var string
     */
    private $imageSrc;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkSpecies
     */
    private $species;


    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return SkSpeciesImageRef
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isPrimary
     *
     * @param boolean $isPrimary
     *
     * @return SkSpeciesImageRef
     */
    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = $isPrimary;

        return $this;
    }

    /**
     * Get isPrimary
     *
     * @return boolean
     */
    public function getIsPrimary()
    {
        return $this->isPrimary;
    }

    /**
     * Set imageUrl
     *
     * @param string $imageUrl
     *
     * @return SkSpeciesImageRef
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set imageSrc
     *
     * @param string $imageSrc
     *
     * @return SkSpeciesImageRef
     */
    public function setImageSrc($imageSrc)
    {
        $this->imageSrc = $imageSrc;

        return $this;
    }

    /**
     * Get imageSrc
     *
     * @return string
     */
    public function getImageSrc()
    {
        return $this->imageSrc;
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
     * Set species
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpecies $species
     *
     * @return SkSpeciesImageRef
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
}

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`skaphandrus_v4`@`localhost` SQL SECURITY DEFINER VIEW `skaphandrus_v4`.`sk_identification_criteria_matrix_2` AS (select 1 AS priority, sk_phylum.kingdom_id AS kingdom_id, sk_class.phylum_id AS phylum_id, sk_order.class_id AS class_id, sk_family.order_id AS order_id, sk_genus.family_id AS family_id, sk_species.genus_id AS genus_id, sk_species.id AS species_id, sk_identification_species_character.character_id AS character_id, sk_identification_character.criteria_id AS criteria_id from ((((((((sk_species join sk_identification_species_character on((sk_species.id = sk_identification_species_character.species_id))) join sk_identification_character on((sk_identification_species_character.character_id = sk_identification_character.id))) join sk_genus on((sk_genus.id = sk_species.genus_id))) join sk_family on((sk_family.id = sk_genus.family_id))) join sk_order on((sk_order.id = sk_family.order_id))) join sk_class on((sk_class.id = sk_order.class_id))) join sk_phylum on((sk_phylum.id = sk_class.phylum_id))) join sk_reino on((sk_reino.id = sk_phylum.kingdom_id))) where family_id = 225 or family_id = 224 having species_id in (select species_id from sk_species_image_ref)) union (select 2 AS priority, sk_phylum.kingdom_id AS kingdom_id, sk_class.phylum_id AS phylum_id, sk_order.class_id AS class_id, sk_family.order_id AS order_id, sk_genus.family_id AS family_id, sk_species.genus_id AS genus_id, sk_species.id AS species_id, sk_identification_genus_character.character_id AS character_id, sk_identification_character.criteria_id AS criteria_id from ((((((((sk_species join sk_genus on((sk_genus.id = sk_species.genus_id))) join sk_identification_genus_character on((sk_genus.id = sk_identification_genus_character.genus_id))) join sk_identification_character on((sk_identification_genus_character.character_id = sk_identification_character.id))) join sk_family on((sk_family.id = sk_genus.family_id))) join sk_order on((sk_order.id = sk_family.order_id))) join sk_class on((sk_class.id = sk_order.class_id))) join sk_phylum on((sk_phylum.id = sk_class.phylum_id))) join sk_reino on((sk_reino.id = sk_phylum.kingdom_id))) where family_id = 225 or family_id = 224 having species_id in (select species_id from sk_species_image_ref))
