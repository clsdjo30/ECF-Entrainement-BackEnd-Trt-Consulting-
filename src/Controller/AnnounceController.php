<?php

namespace App\Controller;

use App\Entity\Announce;
use App\Repository\AnnounceRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/announces'), isGranted('ROLE_CANDIDATE')]
class AnnounceController extends AbstractController
{
    #[Route('/', name: 'app_announces', methods: ('GET'))]
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

        return $this->render('announce/index.html.twig', [
            'announces' => $announces,
        ]);
    }

    #[Route('/{id}', name: 'app_announce_details', methods: ['GET', 'POST'])]
    public function showAnnounceDetails(
        Announce $announce,
    ): Response {
        return $this->render('announce/show_announce_details.html.twig', [
            'announce' => $announce,
        ]);
    }
}
