<?php

namespace Mems\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MemsUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
