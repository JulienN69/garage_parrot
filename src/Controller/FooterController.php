<?php

namespace App\Controller;

use App\Repository\SchedulesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class FooterController extends AbstractController
{
    #[Route('/footer', name: 'footer')]
    public function index(SchedulesRepository $SchedulesRepository): Response
    {

        $schedules = $SchedulesRepository->findAll();

        return $this->render('partials/footer.html.twig', [
            'controller_name' => 'FooterController',
            'schedules' => $schedules
        ]);
    }
}