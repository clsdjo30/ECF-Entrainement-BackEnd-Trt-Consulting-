<?php

namespace App\Controller;

use App\Repository\AnnounceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        AnnounceRepository $announceRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $data = $announceRepository->findAll();

        $announces = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );


        return $this->render('home/index.html.twig', [
            'announces' => $announces,
        ]);
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
