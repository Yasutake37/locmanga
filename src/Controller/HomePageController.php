<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\FormMangaType;

class HomePageController extends AbstractController
{
    /**
     * @Route("/home/page", name="home_page")
     */
    public function index(): Response
    {
        $form = $this->createForm(FormMangaType::class);
        return $this->render('home_page/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
