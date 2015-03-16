<?php

namespace Nastycode\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;


class PostsController extends Controller
{
    /**
     * @Route("/nastycodes")
     * @Template()
     */
    public function postsAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('NastycodeFrontBundle:Publication')
        ;
        $posts = $repository->findAll();

        $user = $this->getUser();
        return $this->render('NastycodeFrontBundle:Posts:posts.html.twig', array(
            'user' => $user,
            'posts' => $posts,
        ));

    }


    /**
     * @Route("/nastycode")
     * @Template()
     */
    public function postAction()
    {
        $user = $this->getUser();
        return $this->render('NastycodeFrontBundle:Posts:post.html.twig', array(
            'user' => $user
        ));
    }   

    /**
     * @Route("/addPost")
     * @Template()
     */
    public function addPostAction()
    {
        $user = $this->getUser();
        return $this->render('NastycodeFrontBundle:Posts:addPost.html.twig', array(
            'user' => $user
        ));
    }   
}