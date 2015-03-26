<?php

namespace Mems\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Mems\MemsBundle\Entity\Mem", mappedBy="createdBy")
     * @var ArrayCollection
     */
    protected $mems;

    /**
     * @ORM\OneToMany(targetEntity="Mems\MemsBundle\Entity\Comment", mappedBy="createdBy")
     * @var ArrayCollection
     */
    protected $comments;

    /**
     * @ORM\OneToMany(targetEntity="Mems\MemsBundle\Entity\Rating", mappedBy="createdBy")
     * @var ArrayCollection
     */
    protected $ratings;
    
    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) */
    protected $facebook_id;
 
    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebook_access_token;
    
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
     * Constructor
     */
    public function __construct()
    {   
        $date = null;
            
        parent::__construct();
        $this->roles = ['ROLE_USER'];
        $this->mems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ratings = new \Doctrine\Common\Collections\ArrayCollection();
        
    }
 
    /**
     * @param \DateTime $date
     *
     * @return expiresAt
     */
   public function ExpiresAt(\DateTime $date = null)
   {
      if($date instanceof DateTime){
            $this->expiresAt = $date;
      } 
    }
    
       /**
     * @param \DateTime $date
     *
     * @return expiresAt
     */
   public function credentialsExpireAt(\DateTime $date = null)
   {
      if($date instanceof DateTime){
            $this->expiresAt = $date;
      } 
    }
  
    
    /**
     * Add mems
     *
     * @param \Mems\MemsBundle\Entity\Mem $mems
     * @return User
     */
    public function addMem(\Mems\MemsBundle\Entity\Mem $mems)
    {
        $this->mems[] = $mems;

        return $this;
    }

    /**
     * Remove mems
     *
     * @param \Mems\MemsBundle\Entity\Mem $mems
     */
    public function removeMem(\Mems\MemsBundle\Entity\Mem $mems)
    {
        $this->mems->removeElement($mems);
    }

    /**
     * Get mems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMems()
    {
        return $this->mems;
    }

    /**
     * Add comments
     *
     * @param \Mems\MemsBundle\Entity\Comment $comments
     * @return User
     */
    public function addComment(\Mems\MemsBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Mems\MemsBundle\Entity\Comment $comments
     */
    public function removeComment(\Mems\MemsBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add ratings
     *
     * @param \Mems\MemsBundle\Entity\Rating $ratings
     * @return User
     */
    public function addRating(\Mems\MemsBundle\Entity\Rating $ratings)
    {
        $this->ratings[] = $ratings;

        return $this;
    }

    /**
     * Remove ratings
     *
     * @param \Mems\MemsBundle\Entity\Rating $ratings
     */
    public function removeRating(\Mems\MemsBundle\Entity\Rating $ratings)
    {
        $this->ratings->removeElement($ratings);
    }

    /**
     * Get ratings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRatings()
    {
        return $this->ratings;
    }
    
    /**
     * Set facebook_id
     *
     * @param string $facebookId
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;
 
        return $this;
    }
 
    /**
     * Get facebook_id
     *
     * @return string 
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }
 
    /**
     * Set facebook_access_token
     *
     * @param string $facebookAccessToken
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;
 
        return $this;
    }
 
    /**
     * Get facebook_access_token
     *
     * @return string 
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }
}
