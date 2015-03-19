<?php

namespace Nastycode\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Nastycode\Bundle\UserBundle\Form\IdentityPictureType;
use Nastycode\Bundle\FrontBundle\Entity\Commentaires;
use Nastycode\Bundle\FrontBundle\Entity\Publication;


class AccountController extends Controller
{
    /**
     * @Route("/me")
     * @Template()
     */
    public function accountAction()
    {
            $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('NastycodeFrontBundle:Publication')
            ;
            $posts = $repository->findBy(array(), array());

            $commentrepository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('NastycodeFrontBundle:Commentaires')
            ;
            $comments = $commentrepository->findBy(array(), array());

            $commentaires = new Commentaires();
            $commentaires->getPost();

            $user = $this->getUser();
            return $this->render('NastycodeFrontBundle:Account:account.html.twig', array(
                'posts' => $posts,
                'comments' => $comments,
                'user' => $user,
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

            return new RedirectResponse($this->generateUrl('nastycode_front_account_account'));
        }

        return $this->render('NastycodeFrontBundle:Account:upload.html.twig',
            array (
                'user' => $user,
                'form' => $form->createView()
            )
        );
    }
}