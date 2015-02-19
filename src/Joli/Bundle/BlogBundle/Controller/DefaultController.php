<?php

namespace Joli\Bundle\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Joli\Bundle\BlogBundle\Entity\Post;
use Joli\Bundle\BlogBundle\Entity\category;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
    /**
     * @Route("/time")
     * @Template()
     */
    public function timeAction()
    {
    	$em = $this->container->get('doctrine')->getManager();
    	$category = new category();
    	$category->setName('PHP');
    	$post1 = new Post(); 
    	$post1->setTitle('Coucou');
    	$post1->setBody('fhgqfhgihoethiorzhi');	
    	$post1->setIsPublished(true);
    	$post1->setCategory($category);

    	$em->persist($category);
		$em->persist($post1);

		$em->flush();

    	$date = date('G i');
        return array('date' => $date);
    }
    /**
     * @Route("/square/{number}")
     * @Template()
     */
    public function numberAction($number)
    {
    	$number *= $number;
        return array('number' => $number);
    }
}