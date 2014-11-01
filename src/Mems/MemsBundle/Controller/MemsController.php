<?php

namespace Mems\MemsBundle\Controller;

use Mems\MemsBundle\Form\CommentType;
use Mems\MemsBundle\Form\AddCommentType;
use Mems\MemsBundle\Entity\Comment;
use Mems\MemsBundle\Form\AddMemType;
use Mems\MemsBundle\Entity\Mem;
use Symfony\Component\HttpFoundation\Request;
use Mems\CoreBundle\Controller\Controller;

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
        $request = $this->getRequest();
        $user = $this->getUser();
        $mem = $this->getDoctrine()
            ->getRepository('MemsMemsBundle:Mem')
            ->findOneBy([
                'slug' => $slug,
            ]);
         
        if (!$mem) {
            throw $this->createNotFoundException('Mem nie istnieje');
        }
        $comment = new Comment();
        $form = $this->createForm(new AddCommentType(), $comment);
         if ($user && $user->hasRole('ROLE_USER')) {
            
            
            $comment->setMem($mem);
            $comment->setCreatedBy($user);

            
            $form->handleRequest($request);
            
            if ($form->isValid()) {
             
                // save data
                $this->persist($comment);
            
                $this->addFlash('notice', "Komentarz został pomyślnie zapisany.");
            
                return $this->redirect($this->generateUrl('mems_show', array(
                    'slug' => $mem->getSlug())
                ));
            }
        }
         
        return $this->render('MemsMemsBundle:Mems:show.html.twig', array(
            'mem' => $mem,
            'form' => $form->createView()
        ));    
    }

}
