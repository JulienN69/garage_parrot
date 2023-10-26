<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        // $getModele = $session->get('getModele');

        $contact = new Contact;
        
        // if ($getModele !== null) {
        //     var_dump($getModele);
        //     $contact->setMessageTitle($getModele);
        //     $form = $this->createForm(ContactType::class, $contact);
        //     $session->remove('getModele');
        // } else {
        //     var_dump($getModele);
        //     $contact->setMessageTitle('');
        //     $form = $this->createForm(ContactType::class, $contact);
        // }

        $getModele = $request->query->get('getModele');

        if (!empty($getModele)) {
            $contact->setMessageTitle($getModele);
            $form = $this->createForm(ContactType::class, $contact);
        }
        $form = $this->createForm(ContactType::class, $contact);
        

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($contact);
            $entityManager->flush();
            $this->addFlash('success', 'formulaire envoyé');
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView()
        ]);
    }

}
