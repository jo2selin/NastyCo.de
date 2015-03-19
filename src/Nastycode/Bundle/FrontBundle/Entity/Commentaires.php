<?php

namespace Nastycode\Bundle\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File;


/**
 * Commentaires
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nastycode\Bundle\FrontBundle\Entity\CommentairesRepository")
 */
class Commentaires
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
     * @ORM\Column(name="commentaires", type="text", length=255)
     */
    private $commentaires;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Publication", inversedBy="commentaires")
     */
    private $post;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Nastycode\Bundle\UserBundle\Entity\User")
     */
    private $user;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set Commentaires
     *
     * @return string
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    /**
     * Get Commentaires
     *
     * @return string
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set Userid
     *
     * @param string $memberid
     * @return Commentaires
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get Userid
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set Postid
     *
     * @param string $userid
     * @return Commentaires
     */
    public function setPost($commentaire)
    {
        $this->post = $commentaire;

        return $this;
    }

    /**
     * Get Postid
     *
     * @return string
     */
    public function getPost()
    {
        return $this->post;
    }
}
