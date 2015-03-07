<?php

namespace Nastycode\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class AccountController extends Controller
{
    /**
     * @Route("/me")
     * @Template()
     */
    public function accountAction()
    {
        $user = $this->getUser();
        return $this->render('NastycodeFrontBundle:Account:account.html.twig', array(
            'user' => $user
        ));
    }
}