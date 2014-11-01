<?php

namespace Mems\MemsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        ));    
    }

}
