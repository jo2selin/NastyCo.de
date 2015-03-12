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
            ->add('NastyCode', 'textarea', array(
                'required' => true,
            ))
            ->add('CleanCode', 'textarea')
            ->add('Lang', 'choice', array(
               'choices' => array('HTML' => 'HTML', 'CSS' => 'CSS', 'SASS' => 'SASS', 'JS' => 'JS', 'PHP' => 'PHP', 'PYTHON' => 'PYTHON', 'RUBY' => 'RUBY'), 'required' => true,
            ))
            ->add('Description', 'textarea', array(
                'required' => true,
            ))
            ->getForm();

        return $this->render('NastycodeFrontBundle:CodeForm:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/postCode2", name="post_code")
     * @Template()
     */
    public function postcodeAction()
    {
        if ($form->isValid()) {
            $code = $this->getPublication();

            $form->handleRequest($request);

            $em = $this->getDoctrine()->getEntityManager();

            $code->sendCode();

            $em->persist($code);
            $em->flush();

            return new RedirectResponse($this->generateUrl('nastycode_front_posts_posts'));
        }
    }
};