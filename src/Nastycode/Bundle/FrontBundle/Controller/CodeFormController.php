<?php

// src/Nastycode/Bundle/FrontBundle/Controller/CodeFormController.php

namespace Nastycode\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class CodeFormController extends Controller
{
     /**
     * @Route("/postCode")
     * @Template()
     */
    public function codeformAction()
    {
        $form = $this->createFormBuilder()
            ->add('titre', 'text')
            ->getForm();

        return $this->render('NastycodeFrontBundle:CodeForm:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
};