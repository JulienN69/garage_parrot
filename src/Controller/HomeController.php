<?php

namespace App\Controller;

use App\Repository\ServicesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index( ServicesRepository $ServicesRepository): Response
    {

        $services = $ServicesRepository->findAll();

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'services' => $services,
        ]);
    }
}
