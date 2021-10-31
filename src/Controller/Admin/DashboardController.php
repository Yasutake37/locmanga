<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $commandes = $this->getDoctrine()->getRepository(Commande::class)->findBy(['etat' => 0]);
       
        $commandesCount = count($commandes);

        return $this->render('dashboard.html.twig', [
            'commande' => $commandesCount,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Loc Manga');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Commande', 'fas fa-clock', Commande::class)
            ->setController(CommandeCrudController::class);
        yield MenuItem::linkToCrud('Mangas', 'fas fa-book', Commande::class)
            ->setController(MangaCrudController::class);
        yield MenuItem::linkToCrud('Séries', 'fas fa-list', Commande::class)
            ->setController(SeriesCrudController::class);
    }
}
