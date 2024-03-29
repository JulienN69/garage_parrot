<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\Admin;
use App\Entity\Contact;
use App\Entity\Reviews;
use App\Entity\Services;
use App\Entity\Equipment;
use App\Entity\Schedules;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');

        return $this->render('admin/dashboard.html.twig');
    }

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Garage Parrot');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('équipements', 'fas fa-list', Equipment::class);
        yield MenuItem::linkToCrud('voitures', 'fas fa-car', Car::class);
        yield MenuItem::linkToCrud('avis', 'fas fa-align-center', Reviews::class);
        yield MenuItem::linkToCrud('contact', 'fa fa-envelope-open', Contact::class);
        if ($this->security->isGranted('ROLE_ADMIN')) {
            yield MenuItem::linkToCrud('services', 'fas fa-id-card', Services::class);
            yield MenuItem::linkToCrud('utilisateurs', 'fas fa-user', Admin::class);
            yield MenuItem::linkToCrud('horaires', 'fas fa-history', Schedules::class);
        }

    }
}
