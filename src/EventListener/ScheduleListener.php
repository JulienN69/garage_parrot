<?php

namespace App\EventListener;

use App\Repository\SchedulesRepository;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;

class ScheduleListener
{
    private $schedulesRepository;
    private $twig;
    private $requestStack;

    public function __construct(SchedulesRepository $schedulesRepository, Environment $twig, RequestStack $requestStack)
    {
        $this->schedulesRepository = $schedulesRepository;
        $this->twig = $twig;
        $this->requestStack = $requestStack;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();
        if (is_array($controller)) {
            $controller = $controller[0];
        }

        // Check if the controller is a TwigController
        // if ($controller instanceof \Symfony\Bundle\FrameworkBundle\Controller\TemplateController) {
            $schedules = $this->schedulesRepository->findAll();
            $request = $this->requestStack->getCurrentRequest();
            $this->twig->addGlobal('schedules', $schedules);
        // }
    }
}
