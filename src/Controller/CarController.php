<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    #[Route('/car', name: 'car', methods:['GET'])]
    public function index(CarRepository $carRepository): Response
    {
        return $this->render('car/index.html.twig', [
            'controller_name' => 'CarController',
            'cars' => $carRepository->findAll()
        ]);
    }

    // <----------------------- READ --------------------------->

    #[Route('/car/{id}', name: 'car_display', methods:['GET'], requirements:['id'=>'\d+'])]
    public function display(CarRepository $carRepository,int $id): Response
    {
        return $this->render('car/display.html.twig', [
            'car' => ($carRepository->find($id))
        ]);
    }
    
}
