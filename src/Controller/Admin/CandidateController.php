<?php

namespace App\Controller\Admin;

use App\Entity\Candidate;
use App\Form\CandidateType;
use App\Repository\CandidateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

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


    /*
     * Display information about the Candidate
     */
    #[Route('/{id}', name: 'app_candidate_details', methods: ['GET', 'POST'])]
    #[ParamConverter('candidate', options: ['id' => 'candidate_id'])]
    public function candidateShow(): Response
    {
        $candidate = new Candidate();

        return $this->render('candidate/profil/details.html.twig', [
            'candidate' => $candidate,
        ]);
    }

    /**
     * Displays a form to edit an existing Candidate Entity.
     */
    #[Route('/{id}/edit', name: 'app_candidate_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Candidate $candidate,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger
    ): Response {
        $form = $this->createForm(CandidateType::class, $candidate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cvFile = $form->get('cv')->getData();

            if ($cvFile) {
                $originalFilename = pathinfo($cvFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid('000', true).'.'.$cvFile->guessExtension();

                try {
                    $cvFile->move(
                        $this->getParameter('cvs_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Un Problème est survenu lors du téléchargement de votre fichier ! ');
                }
                $candidate->setCvFile($newFilename);

                $entityManager->flush();
                $this->addFlash('success', 'Vos information ont bien été mise à jour ! ');

                return $this->redirectToRoute('app_candidate_details', ['id' => 'app.user.candidate.id']);
            }

        }

        return $this->render('candidate/profil/edit.html.twig', [
            'candidate' => $candidate,
            'form' => $form->createView(),
        ]);


    }
}
