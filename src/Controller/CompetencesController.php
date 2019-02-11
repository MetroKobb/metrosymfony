<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Httpoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Competences;
use App\Form\CompetencesType;

class CompetencesController extends AbstractController
{
    
    public function create()
    {
        $competences = new Competences();
        $form = $this->createForm(CompetencesType::class, $competences);
        
        return $this->render('competences/create4.html.twig', [
            'entity' => $competences,
            'form' => $form->createView(),
            ]
            );
    }
    
     public function valid(Request $request)
    {
        $competences = new Competences();
        $form = $this->createForm(CompetencesType::class, $competences);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $competences = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($competences);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_lucky_number');
        }
    
        return $this->render('competences/create4.html.twig', [
            'entity' => $competences,
            'form' => $form->createView(),
            ]
        );
    }
    
    public function edit($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $competences = $entityManager->getRepository(Competences::class)->findOneBy(['id' => $id]);
        $form = $this->createForm(CompetencesType::class, $competences);
        return $this->render('competences/create4.html.twig', [
            'entity' => $competences,
            'form' => $form->createView(),
            ]
        );
    }
    
}


