<?php
// src/Nastycode/Bundle/UserBunble/Entity/User.php

namespace Nastycode\Bundle\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File;

/**
 * @ORM\Entity
 * @ORM\Table(name="Nasty_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $pictureName;

/**
     * @ORM\Column(type="text", nullable=true)
     */
    public $likes;

    /**
     * @Assert\File(maxSize="500k")
     */
    public $file;

    /**
     * @ORM\OneToMany(targetEntity="Nastycode\Bundle\FrontBundle\Entity\Publication", mappedBy="user")
     **/
    protected $posts;

    /**
     * @ORM\OneToMany(targetEntity="Nastycode\Bundle\FrontBundle\Entity\Commentaires", mappedBy="user")
     **/
    protected $commentaires;

    public function getWebPath()
    {
        return null === $this->pictureName ? null : $this->getUploadDir().'/'.$this->pictureName;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/pictures';
    }

    protected  function realPath()
    {
        return __DIR__.'/../../../../../web/uploads/pictures/nastypic_'.$this->id.'.jpg';
    }

    public function uploadProfilePicture()
    {
        if ($this->pictureName) {
            if ($file = $this->realPath()) {
                unlink($file);
            }
        }

        $this->file->move($this->getUploadRootDir(), $this->pictureName = $filename = ('nastypic_'.$this->id.'.'.$this->file->getClientOriginalExtension()));
        $this->pictureName = $filename = ('nastypic_'.$this->id.'.'.$this->file->getClientOriginalExtension());

        $this->file = null;
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
     * Set pictureName
     *
     * @param string $pictureName
     * @return User
     */
    public function setPictureName($pictureName)
    {
        $this->pictureName = $pictureName;

        return $this;
    }

    /**
     * Get pictureName
     *
     * @return string 
     */
    public function getPictureName()
    {
        return $this->pictureName;
    }

    /**
     * Set likes
     *
     * @param string $likes
     * @return User
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * Get likes
     *
     * @return string 
     */
    public function getLikes()
    {
        return $this->likes;
    }

    public function getPosts(){
        return $this->posts;
    }

    public function getCommentaires(){
        return $this->commentaires;
    }
}
