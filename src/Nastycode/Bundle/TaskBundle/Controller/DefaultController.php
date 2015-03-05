<?php

namespace Nastycode\Bundle\TaskBundle\TaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class DefaultController extends Controller
{
    public function newAction(Request $request)
    {
        // crée une tâche et lui donne quelques données par défaut pour cet exemple
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', 'text')
            ->add('dueDate', 'date')
            ->add('save', 'submit')
            ->getForm();

        return $this->render('NastycodeBundleTaskBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
