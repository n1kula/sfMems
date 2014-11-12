<?php

namespace Mems\MemsBundle\Controller;

use Mems\MemsBundle\Form\CommentType;
use Mems\MemsBundle\Form\AddCommentType;
use Mems\MemsBundle\Entity\Comment;
use Mems\MemsBundle\Entity\Rating;
use Mems\MemsBundle\Form\RatingType;
use Mems\MemsBundle\Form\AddRatingType;
use Mems\MemsBundle\Form\AddMemType;
use Mems\MemsBundle\Entity\Mem;
use Symfony\Component\HttpFoundation\Request;
use Mems\CoreBundle\Controller\Controller;

class MemsController extends Controller
{
    public function listAction($page)
    {
        $mems = $this->getDoctrine()
                ->getRepository('MemsMemsBundle:Mem')
                 ->findBy(
                ['isAccepted' => true],
                ['createdAt' => 'desc']
            );
         $paginator  = $this->get('knp_paginator');
         $pages = $paginator->paginate(
                $mems,
                $page,
                5
        );
        return $this->render('MemsMemsBundle:Mems:list.html.twig', array(
            'pages' =>$pages,
        ));
        
    }
    
    public function listUnacceptedAction($page)
    {
        $mems = $this->getDoctrine()
                ->getRepository('MemsMemsBundle:Mem')
                 ->findBy(
                ['isAccepted' => false],
                ['createdAt' => 'desc']
            );
         $paginator  = $this->get('knp_paginator');
         $pages = $paginator->paginate(
                $mems,
                $page,
                5
        );
        return $this->render('MemsMemsBundle:Mems:listUnaccepted.html.twig', array(
            'pages' =>$pages,
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
        $form1 = $this->createForm(new AddCommentType(), $comment);
         if ($user && $user->hasRole('ROLE_USER')) {
            
            $comment->setHost();
            $comment->setIp();
            $comment->setUserAgent();
            $comment->setMem($mem);
            $comment->setCreatedBy($user);

            
            $form1->handleRequest($request);
            
            if ($form1->isValid()) {
             
                // save data
                $this->persist($comment);
            
                $this->addFlash('notice', "Komentarz został pomyślnie zapisany.");
            
                return $this->redirect($this->generateUrl('mems_show', array(
                    'slug' => $mem->getSlug())
                ));
            }
        }
        $rating = new Rating();
        $form2 = $this->createForm(new AddRatingType(), $rating);
        $rating->setMem($mem);
        $rating->setCreatedBy($user);
        $form2->handleRequest($request);
        
       
        
        
        if ($form2->isValid()) {
             
                // save data
                $this->persist($rating);
            
                $this->addFlash('notice', "Ocena została pomyślnie zapisana.");
            
                return $this->redirect($this->generateUrl('mems_show', array(
                    'slug' => $mem->getSlug())
                ));
            }
        $averageRating = $this->getDoctrine()
            ->getRepository('MemsMemsBundle:Rating')
            ->getMemAvgRating($mem);
        
        return $this->render('MemsMemsBundle:Mems:show.html.twig', array(
            'mem' => $mem,
            'form1' => $form1->createView(),
            'averageRating' => $averageRating,
            'form2' => $form2->createView()
        ));    
        
    }   
        
    public function showRandomAction()
    {
        $request = $this->getRequest();
        $user = $this->getUser();
        $mem = $this->getDoctrine()
            ->getRepository('MemsMemsBundle:Mem')
            ->getRandom();
        
        
        $comment = new Comment();
        $form1 = $this->createForm(new AddCommentType(), $comment);
         if ($user && $user->hasRole('ROLE_USER')) {
            
            $comment->setHost();
            $comment->setIp();
            $comment->setUserAgent();
            $comment->setMem($mem);
            $comment->setCreatedBy($user);

            
            $form1->handleRequest($request);
            
            if ($form1->isValid()) {
             
                // save data
                $this->persist($comment);
            
                $this->addFlash('notice', "Komentarz został pomyślnie zapisany.");
            
                return $this->redirect($this->generateUrl('mems_show', array(
                    'slug' => $mem->getSlug())
                ));
            }
        }
        $rating = new Rating();
        $form2 = $this->createForm(new AddRatingType(), $rating);
        $rating->setMem($mem);
        $rating->setCreatedBy($user);
        $form2->handleRequest($request);
        
       
        
        
        if ($form2->isValid()) {
             
                // save data
                $this->persist($rating);
            
                $this->addFlash('notice', "Ocena została pomyślnie zapisana.");
            
                return $this->redirect($this->generateUrl('mems_show', array(
                    'slug' => $mem->getSlug())
                ));
            }
        $averageRating = $this->getDoctrine()
            ->getRepository('MemsMemsBundle:Mem')
            ->getMemAvgRating($mem);
        
        return $this->render('MemsMemsBundle:Mems:show.html.twig', array(
            'mem' => $mem,
            'form1' => $form1->createView(),
            'averageRating' => $averageRating,
            'form2' => $form2->createView()
        ));
    }
    
    public function addAction(Request $request)
    {
        $user = $this->getUser();
        
        if (!$user || !$user->hasRole('ROLE_USER')) {
            throw $this->createAccessDeniedException("Nie posiadasz odpowiednich uprawnień!");
        }
        
        $mem = new Mem();
        $mem->setCreatedBy($user);
        
        $form = $this->createForm(new AddMemType(), $mem);
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            
            // save data
            $this->persist($mem);
            
            $this->addFlash('notice', "Mem został pomyślnie dodane i oczekuje w poczekalni.");
            
            return $this->redirect($this->generateUrl('mems_list'));
        }
        
        
        return $this->render('MemsMemsBundle:Mems:add.html.twig', array(
            'form'  => $form->createView()
        ));
    }
    
  
}
