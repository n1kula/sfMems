<?php

namespace Mems\MemsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mems\MemsBundle\Controller\MemsController\MemsBundle\Form\CommentType;
use Mems\MemsBundle\Form\AddCommentType;
use Mems\MemsBundle\Entity\Comment;

class MemsController extends Controller
{
    public function listAction()
    {
        $mems = $this->getDoctrine()
                ->getRepository('MemsMemsBundle:Mem')
                ->findBy([
                    'isAccepted' => true,
                ]);
        return $this->render('MemsMemsBundle:Mems:list.html.twig', array(
            'mems' =>$mems,
        ));
        
    }

    public function showAction($slug)
    {
        $mem = $this->getDoctrine()
            ->getRepository('MemsMemsBundle:Mem')
            ->findOneBy([
                'slug' => $slug,
            ]);
         
        if (!$mem) {
            throw $this->createNotFoundException('Mem nie istnieje');
        }
            
        return $this->render('MemsMemsBundle:Mems:show.html.twig', array(
            'mem' => $mem,
            'form' => $form->createView()
        ));    
    }

}
