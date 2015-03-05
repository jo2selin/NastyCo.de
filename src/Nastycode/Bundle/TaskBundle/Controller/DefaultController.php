<?php

namespace Nastycode\Bundle\FrontBundle\TaskBundle\Controller;

use Symfony\Bundle\TaskBundle\Controller\Controller;
use Symfony\TaskBundle\Entity\Task;
use Symfony\Component\HttpFoundation\Request;

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
