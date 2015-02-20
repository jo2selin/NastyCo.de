<?php

namespace Nastycode\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Nastycode\Bundle\FrontBundle\Form\SignInPostType;
use Nastycode\Bundle\FrontBundle\Entity\Users;

class HomeController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $post = new Users();
        $form = $this->createForm(new SignInPostType(), $post);
        return array(
            'form' => $form->createView(),
        );
        $form->handleRequest($request);
        if ($form->isValid()){
            return $this->redirect($this->generateUrl('task_success'));
        }
    }
    /**
     * @Route("/")
     * @Template()
     */
    public function formAction(Request $request)
    {
        // $post = new Post();
        $form = $this->createForm(new SignInPostType());
        return array(
            'form' => $form->createView(),
        );
    }
}