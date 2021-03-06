<?php

namespace Nastycode\Bundle\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File;



/**
 * Publication
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nastycode\Bundle\FrontBundle\Entity\PublicationRepository")
 */
class Publication
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
     * @ORM\ManyToOne(targetEntity="Nastycode\Bundle\UserBundle\Entity\User")
     */
    private $user;

 /**
     * @var string
     *
     * @ORM\Column(name="title", type="text")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="code_nasty", type="text")
     */
    private $codeNasty;

    /**
     * @var string
     *
     * @ORM\Column(name="code_clean", type="text")
     */
    private $codeClean;

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=255)
     */
    private $lang;

    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="likes", type="integer")
     */
    private $likes = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean")
     */
    private $published = true;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Publication", inversedBy="commentaires")
     */
    private $post;

    /**
     * @ORM\OneToMany(targetEntity="Commentaires", mappedBy="post")
     **/
    private $commentaires;

    public function __construct() {
        $this->date=new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * @param mixed $commentaires
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;
    }

    public function __toString() {
        return $this->title;
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


    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set member
     *
     * @param string $member
     * @return Publication
     */
    public function setMember($user)
    {
        $this->member = $user;

        return $this;
    }

    /**
     * Get member
     *
     * @return string 
     */
    public function getMember()
    {
        return $this->id;
    }

    /**
     * Set codeNasty
     *
     * @param string $codeNasty
     * @return Publication
     */
    public function setCodeNasty($codeNasty)
    {
        $this->codeNasty = $codeNasty;

        return $this;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Set description
     *
     * @param text $description
     * @return Publication
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get codeNasty
     *
     * @return string 
     */
    public function getCodeNasty()
    {
        return $this->codeNasty;
    }

    public function getUser()
    {
        return $this->user;
    }

    /**
    * Set User
    *
    * @return string
    */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Set codeClean
     *
     * @param string $codeClean
     * @return Publication
     */
    public function setCodeClean($codeClean)
    {
        $this->codeClean = $codeClean;

        return $this;
    }

    /**
     * Get codeClean
     *
     * @return string 
     */
    public function getCodeClean()
    {
        return $this->codeClean;
    }

    /**
     * Set lang
     *
     * @param string $lang
     * @return Publication
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string 
     */
    public function getLang()
    {
        return $this->lang;
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
     * Set date
     *
     * @param \DateTime $date
     * @return Publication
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Publication
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Publication
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
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
