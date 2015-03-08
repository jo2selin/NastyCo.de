<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('nastycode_task_homepage', new Route('/hello/{name}', array(
    '_controller' => 'NastycodeTaskBundle:Default:index',
)));

return $collection;