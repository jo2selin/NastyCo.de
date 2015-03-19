<?php

namespace Nastycode\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Nastycode\Bundle\FrontBundle\Entity\Commentaires;

class PostsController extends Controller
{
    /**
     * @Route("/nastycodes")
     * @Template()
     */
    public function postsAction(Request $request)
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('NastycodeFrontBundle:Publication')
        ;
        $posts = $repository->findBy(array(), array(), 10);

        $commentaires = new Commentaires();

        $commentaires -> setUsername($this -> getUser() -> getUsername());

        $comment = $this->get('form.factory')->createBuilder('form', $commentaires)
            ->add('commentaires', 'textarea')
            ->add('save',      'submit')
            ->getForm()
        ;

        // On fait le lien Requête <-> Formulaire
        // À partir de maintenant, la variable $commentaires contient les valeurs entrées dans le formulaire par le visiteur
        $comment->handleRequest($request);

        // On vérifie que les valeurs entrées sont correctes
        // (Nous verrons la validation des objets en détail dans le prochain chapitre)
        if ($comment->isValid()) {
            // On l'enregistre notre objet $commentaires dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaires);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            // On redirige vers la page de visualisation de l'annonce nouvellement créée
            return $this->redirect($this->generateUrl('nastycode_comment_code', array('id' => $commentaires->getId())));
        }

        $user = $this->getUser();
        return $this->render('NastycodeFrontBundle:Posts:posts.html.twig', array(
            'user' => $user,
            'posts' => $posts,
            'comment' => $comment->createView(),
        ));
    }


    /**
     * @Route("/nastycode/{id}")
     * @Template()
     */
    public function postAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('NastycodeFrontBundle:Publication')
        ;
        $posts = $repository->findAll();

        $user = $this->getUser();
        return $this->render('NastycodeFrontBundle:Posts:post.html.twig', array(
            'user' => $user,
            'posts' => $posts,
        ));
    }   

}