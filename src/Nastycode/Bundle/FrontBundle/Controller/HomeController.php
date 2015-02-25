<?php

namespace Nastycode\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Nastycode\Bundle\FrontBundle\Form\SignInPostType;


class HomeController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        // $post = new User();
        $form = $this->createForm(new SignInPostType());
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
    // public function javascriptsAction()
    // {
    //     return $this->render('NastycodeFrontBundle:Home:javascripts.html.twig');
    // }
}