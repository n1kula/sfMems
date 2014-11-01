<?php

namespace Mems\LayoutBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MemsLayoutBundle:Default:index.html.twig');
    }
}
