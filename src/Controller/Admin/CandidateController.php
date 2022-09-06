<?php

namespace App\Controller\Admin;

use App\Entity\Announce;
use App\Repository\AnnounceRepository;
use App\Repository\CandidateRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/candidate'), isGranted('ROLE_CANDIDATE')]
class CandidateController extends AbstractController
{
    #[Route('/', name: 'app_candidate', methods: ('GET'))]
    public function index(CandidateRepository $candidateRepository): Response
    {
        return $this->render('candidate/index.html.twig', [
            'candidate' => $candidateRepository->findAll(),
        ]);
    }

    #[Route('/details', name: 'app_candidate_details', methods: ('GET'))]
    #[ParamConverter('candidate', options: ['id' => 'candidate_id'])]
    public function details(): Response
    {
        return $this->render('candidate/profil/details.html.twig');
    }

    #[Route('/annonces', name: 'app_candidate_announces', methods: ('GET'))]
    #[ParamConverter('candidate', options: ['id' => 'candidate_id'])]
    public function showAnnounces(
        UserRepository $userRepository,
        AnnounceRepository $announceRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {

        if ($userRepository->findUserNotActive()) {
            throw $this->createAccessDeniedException();
        }

        $data = $announceRepository->findAll();

        $announces = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('candidate/announce/index.html.twig', [
            'announces' => $announces,
        ]);
    }

    #[Route('/annonce/{id}', name: 'app_candidate_announce_show', methods: ['GET', 'POST'])]
    public function showAnnounceDetails(
        Announce $announce,
    ): Response {
        return $this->render('candidate/announce/show_announce_details.html.twig', [
            'announce' => $announce,
        ]);
    }


}
