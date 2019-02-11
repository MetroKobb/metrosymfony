<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Httpoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Profil;
use App\Form\ProfilType;

class ProfilController extends AbstractController
{
    
    public function create()
    {
        $profil = new Profil();
        $form = $this->createForm(ProfilType::class, $profil);
        
        return $this->render('profil/create3.html.twig', [
            'entity' => $profil,
            'form' => $form->createView(),
            ]
            );
    }
    
     public function valid(Request $request)
    {
        $profil = new Profil();
        $form = $this->createForm(ProfilType::class, $profil);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $profil = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profil);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_lucky_number');
        }
    
        return $this->render('profil/create3.html.twig', [
            'entity' => $profil,
            'form' => $form->createView(),
            ]
        );
    }
    
    public function edit($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $formation = $entityManager->getRepository(Profil::class)->findOneBy(['id' => $id]);
        $form = $this->createForm(ProfilType::class, $profil);
        return $this->render('profil/create3.html.twig', [
            'entity' => $profil,
            'form' => $form->createView(),
            ]
        );
    }
    
}


