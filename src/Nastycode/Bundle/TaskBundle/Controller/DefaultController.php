<?php

namespace Nastycode\Bundle\TaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nastycode\Bundle\FrontBundle\Entity\Publication;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function addAction(Request $request)
    {
        // On crée un objet Advert
        $publication = new Publication();

        $form = $this->get('form.factory')->createBuilder('form', $publication)
          ->add('description', 'textarea')
          ->add('codenasty',   'textarea')
          ->add('codeclean',    'textarea')
          ->add('lang',    'choice',        array(
                    'choices'   => array('html' => 'HTML', 'css' => 'CSS', 'php' => 'PHP', 'JS' => 'JavaScript'),
                    'required'  => false,))
          ->add('save',      'submit')
              ->getForm()
    ;

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
      return $this->redirect($this->generateUrl('nastycode_form_code', array('id' => $publication->getId())));
    }

    // À ce stade, le formulaire n'est pas valide car :
    // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
    // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
    return $this->render('NastycodeTaskBundle:Default:add.html.twig', array(
      'form' => $form->createView(),
    ));
    }
}
