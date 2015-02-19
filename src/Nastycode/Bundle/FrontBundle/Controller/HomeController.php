<?php

namespace Nastycode\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomeController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array('name' => 'Bienvenue !', 'nickName' => 'Joseph');
    }

    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function nameAction($name)
    {
        return array('name' => $name);
    }
}
