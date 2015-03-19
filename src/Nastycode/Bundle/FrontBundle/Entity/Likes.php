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
class Likes
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
     * @var integer
     *
     * @ORM\Column(name="likes", type="integer")
     */
    private $likes = 0;

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
     * Set likes
     *
     * @param integer $likes
     * @return Publication
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * Get likes
     *
     * @return integer
     */
    public function getLikes()
    {
        return $this->likes;
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