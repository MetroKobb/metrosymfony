<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Httpoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Experience;
use App\Form\ExperienceType;

class ExperienceController extends AbstractController
{
    
    public function create()
    {
        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience);
        
        return $this->render('experience/create2.html.twig', [
            'entity' => $experience,
            'form' => $form->createView(),
            ]
            );
    }
    
     public function valid(Request $request)
    {
        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $experience = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($experience);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_lucky_number');
        }
    
        return $this->render('experience/create2.html.twig', [
            'entity' => $experience,
            'form' => $form->createView(),
            ]
        );
    }
    
    public function edit($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $experience = $entityManager->getRepository(Experience::class)->findOneBy(['id' => $id]);
        $form = $this->createForm(ExperienceType::class, $experience);
        return $this->render('experience/create2.html.twig', [
            'entity' => $experience,
            'form' => $form->createView(),
            ]
        );
    }
    
    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $experience = $entityManager->getRepository(Experience::class)->findOneBy(['id' => $id]);
        
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($experience);
            $entityManager->flush();
        

        return $this->redirectToRoute('app_lucky_number');
    }

}


