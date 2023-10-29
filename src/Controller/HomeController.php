<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Repository\ReviewsRepository;
use App\Repository\ServicesRepository;
use App\Repository\SchedulesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ReviewsRepository $ReviewsRepository, ServicesRepository $ServicesRepository , SchedulesRepository $SchedulesRepository): Response
    {

        $services = $ServicesRepository->findAll();

        $schedules = $SchedulesRepository->findAll();

        $reviews = $ReviewsRepository->findAll();

        $calculatedDays = [];
        foreach ($reviews as $review) {

            $date = $review->getUpdatedAt();

            if ($date instanceof DateTimeImmutable) {
                    
                $days = $ReviewsRepository->calculateDays($date)->format('%a');
                $calculatedDays[$review->getId()] = $days;
            }                
        }

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'services' => $services,
            'schedules' => $schedules,
            'reviews' => $reviews,
            'calculatedDays' => $calculatedDays
        ]);
    }
}
