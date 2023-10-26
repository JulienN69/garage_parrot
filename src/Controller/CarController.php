<?php

namespace App\Controller;

use App\Data\SearchCarData;
use App\Form\SearchCarForm;
use App\Repository\CarRepository;
use App\Uploader\CarDirectoryNamer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    #[Route('/car', name: 'car', methods:['GET'])]
    public function index(CarRepository $carRepository, CarDirectoryNamer $directoryNamer, Request $request): Response
    {

        $data = new SearchCarData();
        $data->page = $request->get('page', 1);

        $form = $this->createForm(SearchCarForm::class, $data);
        $form->handleRequest($request);

        $cars = $carRepository->findSearch($data); 
        $imagePaths = [];

        foreach ($cars as $car) {                    
            $directory = $directoryNamer->directoryName($car, null);
            $imageName = $car->getImageName();
            $id = $car->getId();
            $imagePath = '/images/cars/' . $directory . '/' . $imageName;
            $imagePaths[$id] = $imagePath;
        }       

        if ($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('car/_cars.html.twig', ['cars'=> $cars, 'imagePaths' => $imagePaths,])
            ]);
        };

        return $this->render('car/index.html.twig', [
            'controller_name' => 'CarController',
            'cars' => $cars,
            'imagePaths' => $imagePaths,
            'form'=> $form->createView()
        ]);
    }

    // <----------------------- READ --------------------------->

    #[Route('/car/{id}', name: 'car_display', methods:['GET'], requirements:['id'=>'\d+'])]
    public function display(CarDirectoryNamer $directoryNamer, CarRepository $carRepository,int $id): Response
    {
       

        $car = $carRepository->find($id);
        if (!$car) {
            return var_dump('cette voiture existe pas');
        }

        $carPictures = $car->getCarPictures();

        $imageNames = [];
        foreach ($carPictures as $carPicture) {
            $imageNames[] = $carPicture->getPictureName();
        }
                            
        $directory = $directoryNamer->directoryName($car, null);
        $id = $car->getId();
        $imagePath = '/images/cars/' . $directory . '/';

        return $this->render('car/display.html.twig', [
            'imagePath' => $imagePath,
            'imageNames' => $imageNames,
            'car' => ($carRepository->find($id)),
        ]);
    }
    
}
