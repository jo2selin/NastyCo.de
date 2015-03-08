<?php

namespace Nastycode\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Nastycode\Bundle\UserBundle\Form\IdentityPictureType;


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
    /**
     * @Route("/me2", name="upload_file")
     * @Template()
     */
    public function uploadAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(new IdentityPictureType(), $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();

            $user->uploadProfilePicture();

            $em->persist($user);
            $em->flush();

            $this->redirect($this->generateUrl('nastycode_front_account_account'));
        }

        return $this->render('NastycodeFrontBundle:Account:upload.html.twig',
            array (
                'user' => $user,
                'form' => $form->createView()
            )
        );
    }
}