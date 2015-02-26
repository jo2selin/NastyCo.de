<?php

namespace Nastycode\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class AccountController extends Controller
{
    /**
     * @Route("/account")
     * @Template()
     */
    public function accountAction(Request $request)
    {
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