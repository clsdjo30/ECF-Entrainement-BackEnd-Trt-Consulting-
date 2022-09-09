<?php

namespace App\Controller\Admin;

use App\Entity\Recruiter;
use App\Repository\RecruiterRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recruiter'), isGranted('ROLE_RECRUITER')]
class RecruiterController extends AbstractController
{
    #[Route('/', name: 'app_recruiter')]
    public function index(RecruiterRepository $recruiterRepository): Response
    {
        return $this->render('recruiter/index.html.twig', [
            'recruiter' => $recruiterRepository->findAll(),
        ]);
    }

    /*
     * Display information about the Recruiter
     */
    #[Route('/{id}', name: 'app_recruiter_details', methods: ['GET', 'POST'])]
    #[ParamConverter('recruiter', options: ['id' => 'recruiter_id'])]
    public function recruiterShow(
        Recruiter $recruiter
    ): Response {


        return $this->render('recruiter/profil/details.html.twig', [
            'recruiter' => $recruiter,

        ]);
    }


}
