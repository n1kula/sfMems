<?php

namespace Mems\MemsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommentController extends Controller
{
    public function newAction()
    {
        return $this->render('MemsMemsBundle:Comment:new.html.twig', array(
                // ...
            ));    }

    public function editAction($id)
    {
        return $this->render('MemsMemsBundle:Comment:edit.html.twig', array(
                // ...
            ));    }

}
