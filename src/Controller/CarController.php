<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
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

    #[Route('/car/create', name: 'car_create', methods:['GET', 'POST'])]
    public function create(): Response
    {
        $form = $this->createForm(CarType::class);

        return $this->render('car/create.html.twig', [
            'formCar' => $form->createView()
        ]);

    }

    #[Route('/car/{id}', name: 'car_display', methods:['GET'], requirements:['id'=>'\d+'])]
    public function display(CarRepository $carRepository,int $id): Response
    {
         return $this->render('car/display.html.twig', [
             'car' => ($carRepository->find($id))
         ]);
    }



    #[Route('/car/{id}/update', name: 'car_update', methods:['GET', 'POST'], requirements:['id'=>'\d+'])]
    public function update(): Response
    {
        dd(__METHOD__);
    }

    #[Route('/car/{id}/delete', name: 'car_delete', methods:['GET'], requirements:['id'=>'\d+'])]
    public function delete(): Response
    {
        dd(__METHOD__);
    }
    
}
