<?php

namespace App\Controller;

use App\Entity\Services;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/services')]
class ServicesController extends AbstractController
{
    #[Route('/', name: 'app_services_index', priority: 10 ,methods: ['GET'])]
    public function index(ServicesRepository $servicesRepository): Response
    {
        return $this->render('services/index.html.twig', [
            'controller_name' => 'ServicesController',
            'services' => $servicesRepository->findAll(),
        ]);
    }

    #[Route('/index', name: 'app_services_show_all', methods: ['GET'])]
    public function showall(ServicesRepository $servicesRepository): Response
    {
        return $this->render('services/show_all.html.twig', [
            'services' => $servicesRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_services_show', methods: ['GET'])]
    public function show(Services $services): Response
    {
        return $this->render('services/show.html.twig', [
            'service' => $services,
        ]);
    }

}
