<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Manga;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\FormMangaType;

class HomePageController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/home/page", name="home_page")
     */
    public function index(Request $request): Response
    {
        $commande = new Commande();

        $form = $this->createForm(FormMangaType::class);
        $form->handleRequest($request);

        //vérification de la validité du formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            //attribution des variables du formulaire à l'objet Commande
            $commande->setManga($form->get('manga')->getData());
            $commande->setEmail($form->get('email')->getData());
            $commande->setNom($form->get('nom')->getData());
            $commande->setEtat(0);

            //persist => on fixe les datas à un instant T
            $this->entityManager->persist($commande);
            //flush on effectue les changements dans la base de données
            $this->entityManager->flush();

            $this->addFlash(
                'notice', 'Votre commande a été prise en compte'
            );

        }

            return $this->render('home_page/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
