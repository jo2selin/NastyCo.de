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
     * @Assert\File(maxSize="500k")
     */
    public $file;

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
        return 'NastyCo.de/web/uploads/pictures/nastypic_'.$this->id.'.';
    }

    public function uploadProfilePicture()
    {
        //if ($this->pictureName) {
           // if ($file = $this->realPath()) {
           //     unlink($file);
          //  }
        //}

        $this->file->move($this->getUploadRootDir(), $this->pictureName = $filename = ('nastypic_'.$this->id.'.'.$this->file->getClientOriginalExtension()));
        $this->pictureName = $filename = ('nastypic_'.$this->id.'.'.$this->file->getClientOriginalExtension());

        $this->file = null;
    }
}