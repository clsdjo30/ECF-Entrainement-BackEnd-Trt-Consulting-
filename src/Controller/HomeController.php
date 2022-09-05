<?php

namespace App\Controller;

use App\Repository\AddressRepository;
use App\Repository\AnnounceRepository;
use App\Repository\CompanyRepository;
use App\Repository\RecruiterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        AnnounceRepository $announceRepository,
        RecruiterRepository $recruiterRepository,
        CompanyRepository $companyRepository,
        AddressRepository $addressRepository
    ): Response {
        $announces = $announceRepository->findAll();
        $recruiters = $recruiterRepository->findAll();
        $companies = $companyRepository->findAll();
        $addresses = $addressRepository->findAll();


        return $this->render('home/index.html.twig', [
            'announces' => $announces,
            'recruiters' => $recruiters,
            'companies' => $companies,
            'addresses' => $addresses,
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
