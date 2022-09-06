<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/verification', name: 'app_home_verification')]
    public function notVerified(): Response
    {

        return $this->render('home/email_verification.html.twig');
    }

    #[Route('/first-connexion', name: 'app_home_first_connexion')]
    public function pendingValidation(): Response
    {
        return $this->render('home/pending_validation.html.twig');
    }
}
