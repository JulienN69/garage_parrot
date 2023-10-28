<?php

namespace App\Controller;

use App\Entity\Reviews;
use App\Form\ReviewsType;
use App\Repository\ReviewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reviews')]
class ReviewsController extends AbstractController
{
    #[Route('/', name: 'app_reviews_index', methods: ['GET'])]
    public function index(ReviewsRepository $reviewsRepository): Response
    {
        $reviews = $reviewsRepository->findAll();
        $calculatedDays = [];
        foreach ($reviews as $review) {
            $date = $review->getUpdatedAt();
            $days = $reviewsRepository->calculateDays($date)->format('%a');
            $calculatedDays[$review->getId()] = $days;
        }
        
        return $this->render('reviews/index.html.twig', [
            'reviews' => $reviewsRepository->findAll(),
            'calculatedDays' => $calculatedDays
        ]);
    }

    #[Route('/new', name: 'app_reviews_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $review = new Reviews();
        $form = $this->createForm(ReviewsType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('app_reviews_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reviews/new.html.twig', [
            'review' => $review,
            'form' => $form,
        ]);
    }

    #[Route('/show', name: 'app_reviews_show', methods: ['GET'])]
    public function show(ReviewsRepository $reviewsRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $reviews = $reviewsRepository->findAll();
        $calculatedDays = [];
        foreach ($reviews as $review) {
            $date = $review->getUpdatedAt();
            $days = $reviewsRepository->calculateDays($date)->format('%a');
            $calculatedDays[$review->getId()] = $days;
        }

        $review = new Reviews();
        $form = $this->createForm(ReviewsType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('reviews/show.html.twig', [
            'reviews' => $reviewsRepository->findAll(),
            'calculatedDays' => $calculatedDays,
            'review' => $review,
            'form' => $form->createView(),
        ]);
    }

}
