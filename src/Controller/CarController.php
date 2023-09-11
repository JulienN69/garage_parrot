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

// <----------------------- Start CRUD --------------------------->
// <----------------------- CREATE --------------------------->

    #[Route('/car/create', name: 'car_create', methods:['GET', 'POST'])]
    public function create(Request $request, CarRepository $carRepository, EntityManager $entitymanager): Response
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $carRepository->save($car, true);
            // $carRepository->persist($car);
            // $carRepository->flush();
            return $this->redirectToRoute('car');
        }

        return $this->render('car/create.html.twig', [
            'formCar' => $form->createView()
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

    // <----------------------- UPDATE --------------------------->

    #[Route('/car/{id}/update', name: 'car_update', methods:['GET', 'POST'], requirements:['id'=>'\d+'])]
public function update(int $id, Request $request, CarRepository $carRepository): Response
{
    $car = $carRepository->find($id);

    $form = $this->createForm(CarType::class, $car);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $carRepository->save($car, true);

        return $this->redirectToRoute('car');
    }

    return $this->render('car/edit.html.twig', [
        'formCar' => $form->createView()
    ]);
}

    // <----------------------- DELETE --------------------------->

    #[Route('/car/{id}/delete', name: 'car_delete', methods:['GET'], requirements:['id'=>'\d+'])]
    public function delete(int $id, CarRepository $carRepository) : Response {

        $car = $carRepository->find($id);

        $carRepository->remove($car, true);
        return $this->redirectToRoute('car');
    }
    
}
