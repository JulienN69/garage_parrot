<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use Doctrine\ORM\EntityManager;
use App\Repository\CarRepository;
use App\Uploader\CarDirectoryNamer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    #[Route('/car', name: 'car', methods:['GET'])]
    public function index(CarRepository $carRepository, CarDirectoryNamer $directoryNamer): Response
    {
        $cars = $carRepository->findAll(); 
        $imagePaths = [];

        foreach ($cars as $car) {                    
            $directory = $directoryNamer->directoryName($car, null);
            $imageName = $car->getImageName();
            $id = $car->getId();
            $imagePath = '/images/cars/' . $directory . '/' . $imageName;
            $imagePaths[$id] = $imagePath;
        }
               


        return $this->render('car/index.html.twig', [
            'controller_name' => 'CarController',
            'cars' => $cars,
            'imagePaths' => $imagePaths,
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
