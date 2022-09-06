<?php

namespace App\Controller\Admin;

use App\Repository\AnnounceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/candidate'), isGranted('ROLE_CANDIDATE')]
class CandidateController extends AbstractController
{
    #[Route('/', name: 'app_candidate_home', methods: ('GET'))]
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

        return $this->render('candidate/index.html.twig', [
            'announces' => $announces,
        ]);
    }
}
