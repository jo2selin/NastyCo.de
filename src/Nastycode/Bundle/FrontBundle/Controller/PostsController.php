<?php

namespace Nastycode\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Nastycode\Bundle\FrontBundle\Entity\Commentaires;
use Nastycode\Bundle\FrontBundle\Entity\Publication;


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

        $comment = $this->get('form.factory')->createBuilder('form', $commentaires)
            ->setMethod("POST")
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
            return $this->redirect($this->generateUrl('nastycode_front_posts_posts', array('id' => $commentaires->getId())));
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
    public function postAction($id)
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('NastycodeFrontBundle:Publication')
        ;
        $posts = $repository->findById($id);

        $user = $this->getUser();
        return $this->render('NastycodeFrontBundle:Posts:post.html.twig', array(
            'user' => $user,
            'posts' => $posts,
        ));
    }

    /**
     * @Route("/postCode")
     * @Template()
     */
    public function addPostAction(Request $request)
    {

        // On crée un objet Publication

        $user = $this->getUser();
        $publication = new Publication();

        $publication->setUsername($this->getUser()->getUsername());

        $form = $this->get('form.factory')->createBuilder('form', $publication)
            ->add('title', 'text')
            ->add('description', 'textarea')
            ->add('codenasty', 'textarea')
            ->add('codeclean', 'textarea')
            ->add('lang', 'choice', array(
                'choices' => array('html' => 'HTML', 'css' => 'CSS', 'scss' => 'SASS', 'php' => 'PHP', 'javascript' => 'JS', 'ruby' => 'RUBY', 'python' => 'PYTHON')))
            ->add('envoyer', 'submit')
            ->getForm();

        // On fait le lien Requête <-> Formulaire
        // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
        $form->handleRequest($request);

        // On vérifie que les valeurs entrées sont correctes
        // (Nous verrons la validation des objets en détail dans le prochain chapitre)
        if ($form->isValid()) {
            // On l'enregistre notre objet $advert dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $em->persist($publication);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            // On redirige vers la page de visualisation de l'annonce nouvellement créée
            return $this->redirect($this->generateUrl('nastycode_front_posts_posts'));
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('NastycodeFrontBundle:Posts:addPost.html.twig', array(
            'user' => $user,
            'form' => $form->createView()
        ));
    }
}
