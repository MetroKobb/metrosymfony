<?php
// src/Controller/LuckyController.php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use App\Entity\Formation;
use App\Entity\Experience;
use App\Entity\Competences;
use App\Entity\Profil;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends Controller
{
    public function number()
    {
        $number = random_int(0, 100);
        
 $formations = $this->getDoctrine()->getRepository(Formation::class)->findAll();
 $experiences = $this->getDoctrine()->getRepository(Experience::class)->findAll();
 $competences = $this->getDoctrine()->getRepository(Competences::class)->findAll();
 $profils = $this->getDoctrine()->getRepository(Profil::class)->findAll();
        /*return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'*/
            
        return $this->render('lucky/number.html.twig', array(
            'number' => $number,
            'name' => 'Bastien',
            'formations' => $formations,
            'experiences' => $experiences,
            'competences' => $competences,
            'profils' => $profils,
            
            
            
        ));
    }
    
    
    public function createFormation()
    {
        $form=new Formation();
        $form->setName('MaFormation');
        $form->setDate(new \DateTime());
        $form->setPlace('Voiron');
        $form->setDescription('bacsti2d');
        $eManager = $this->getDoctrine()->getManager();
        $eManager->persist($form);
        $eManager->flush();
    }
    
    public function createExperience()
    {
        $form=new Experience();
        $form->setName('MonExperience');
        $form->setDate(new \DateTime());
        $form->setPlace('Voiron');
        $form->setDescription('Gozzi');
        $eManager = $this->getDoctrine()->getManager();
        $eManager->persist($form);
        $eManager->flush();
    }
    
    public function createCompetence()
    {
        $form=new Competences();
        $form->setName('MonCompetence');
        $form->setPercent('75');
        $eManager = $this->getDoctrine()->getManager();
        $eManager->persist($form);
        $eManager->flush();
    }
    
    public function createProfil()
    {
        $form=new Profil();
        $form->setName('Bastien');
        $form->setDescription('mmi');
        $eManager = $this->getDoctrine()->getManager();
        $eManager->persist($form);
        $eManager->flush();
    }
    
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }

}

