<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkUsername
 */
class SkUsername
{
    /**
     * @var string
     */
    private $hash;

    /**
     * @var string
     */
    private $newPasswordHash;

    /**
     * @var string
     */
    private $nome;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $paginaWeb;

    /**
     * @var string
     */
    private $sexo;

    /**
     * @var \DateTime
     */
    private $dataNascimento;

    /**
     * @var string
     */
    private $localidade;

    /**
     * @var integer
     */
    private $paisId;

    /**
     * @var string
     */
    private $idiomaPreferido;

    /**
     * @var boolean
     */
    private $emailMessageAtOnce = '1';

    /**
     * @var boolean
     */
    private $emailCommentAtOnce = '1';

    /**
     * @var string
     */
    private $fotografia;

    /**
     * @var boolean
     */
    private $emailUpdate = '1';

    /**
     * @var string
     */
    private $facebookUid;

    /**
     * @var string
     */
    private $emailHash;

    /**
     * @var string
     */
    private $observations;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $fosUser;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkEmailNotificationTime
     */
    private $emailNotificationTime;

    
        /**
     * @var integer
     */
    private $points;

    

    /**
     * Set hash
     *
     * @param string $hash
     *
     * @return SkUsername
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set newPasswordHash
     *
     * @param string $newPasswordHash
     *
     * @return SkUsername
     */
    public function setNewPasswordHash($newPasswordHash)
    {
        $this->newPasswordHash = $newPasswordHash;

        return $this;
    }

    /**
     * Get newPasswordHash
     *
     * @return string
     */
    public function getNewPasswordHash()
    {
        return $this->newPasswordHash;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return SkUsername
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return SkUsername
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set paginaWeb
     *
     * @param string $paginaWeb
     *
     * @return SkUsername
     */
    public function setPaginaWeb($paginaWeb)
    {
        $this->paginaWeb = $paginaWeb;

        return $this;
    }

    /**
     * Get paginaWeb
     *
     * @return string
     */
    public function getPaginaWeb()
    {
        return $this->paginaWeb;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     *
     * @return SkUsername
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set dataNascimento
     *
     * @param \DateTime $dataNascimento
     *
     * @return SkUsername
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    /**
     * Get dataNascimento
     *
     * @return \DateTime
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * Set localidade
     *
     * @param string $localidade
     *
     * @return SkUsername
     */
    public function setLocalidade($localidade)
    {
        $this->localidade = $localidade;

        return $this;
    }

    /**
     * Get localidade
     *
     * @return string
     */
    public function getLocalidade()
    {
        return $this->localidade;
    }

    /**
     * Set paisId
     *
     * @param integer $paisId
     *
     * @return SkUsername
     */
    public function setPaisId($paisId)
    {
        $this->paisId = $paisId;

        return $this;
    }

    /**
     * Get paisId
     *
     * @return integer
     */
    public function getPaisId()
    {
        return $this->paisId;
    }

    /**
     * Set idiomaPreferido
     *
     * @param string $idiomaPreferido
     *
     * @return SkUsername
     */
    public function setIdiomaPreferido($idiomaPreferido)
    {
        $this->idiomaPreferido = $idiomaPreferido;

        return $this;
    }

    /**
     * Get idiomaPreferido
     *
     * @return string
     */
    public function getIdiomaPreferido()
    {
        return $this->idiomaPreferido;
    }

    /**
     * Set emailMessageAtOnce
     *
     * @param boolean $emailMessageAtOnce
     *
     * @return SkUsername
     */
    public function setEmailMessageAtOnce($emailMessageAtOnce)
    {
        $this->emailMessageAtOnce = $emailMessageAtOnce;

        return $this;
    }

    /**
     * Get emailMessageAtOnce
     *
     * @return boolean
     */
    public function getEmailMessageAtOnce()
    {
        return $this->emailMessageAtOnce;
    }

    /**
     * Set emailCommentAtOnce
     *
     * @param boolean $emailCommentAtOnce
     *
     * @return SkUsername
     */
    public function setEmailCommentAtOnce($emailCommentAtOnce)
    {
        $this->emailCommentAtOnce = $emailCommentAtOnce;

        return $this;
    }

    /**
     * Get emailCommentAtOnce
     *
     * @return boolean
     */
    public function getEmailCommentAtOnce()
    {
        return $this->emailCommentAtOnce;
    }

    /**
     * Set fotografia
     *
     * @param string $fotografia
     *
     * @return SkUsername
     */
    public function setFotografia($fotografia)
    {
        $this->fotografia = $fotografia;

        return $this;
    }

    /**
     * Get fotografia
     *
     * @return string
     */
    public function getFotografia()
    {
        return $this->fotografia;

    }

    /**
     * Set emailUpdate
     *
     * @param boolean $emailUpdate
     *
     * @return SkUsername
     */
    public function setEmailUpdate($emailUpdate)
    {
        $this->emailUpdate = $emailUpdate;

        return $this;
    }

    /**
     * Get emailUpdate
     *
     * @return boolean
     */
    public function getEmailUpdate()
    {
        return $this->emailUpdate;
    }

    /**
     * Set facebookUid
     *
     * @param string $facebookUid
     *
     * @return SkUsername
     */
    public function setFacebookUid($facebookUid)
    {
        $this->facebookUid = $facebookUid;

        return $this;
    }

    /**
     * Get facebookUid
     *
     * @return string
     */
    public function getFacebookUid()
    {
        return $this->facebookUid;
    }

    /**
     * Set emailHash
     *
     * @param string $emailHash
     *
     * @return SkUsername
     */
    public function setEmailHash($emailHash)
    {
        $this->emailHash = $emailHash;

        return $this;
    }

    /**
     * Get emailHash
     *
     * @return string
     */
    public function getEmailHash()
    {
        return $this->emailHash;
    }

    /**
     * Set observations
     *
     * @param string $observations
     *
     * @return SkUsername
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get observations
     *
     * @return string
     */
    public function getObservations()
    {
        return $this->observations;
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
     * @return SkUsername
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
     * Set emailNotificationTime
     *
     * @param \Skaphandrus\AppBundle\Entity\SkEmailNotificationTime $emailNotificationTime
     *
     * @return SkUsername
     */
    public function setEmailNotificationTime(\Skaphandrus\AppBundle\Entity\SkEmailNotificationTime $emailNotificationTime = null)
    {
        $this->emailNotificationTime = $emailNotificationTime;

        return $this;
    }

    /**
     * Get emailNotificationTime
     *
     * @return \Skaphandrus\AppBundle\Entity\SkEmailNotificationTime
     */
    public function getEmailNotificationTime()
    {
        return $this->emailNotificationTime;
    }
    
    
        /**
     * Set points
     *
     * @param integer points
     *
     * @return SkUsername
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get paisId
     *
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }
    
    
    
}

