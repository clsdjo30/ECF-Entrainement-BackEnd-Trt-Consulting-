<?php

namespace App\Controller\Admin;

use App\Entity\Recruiter;
use App\Form\RecruiterType;
use App\Repository\RecruiterRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        UserRepository $userRepository
    ): Response {

        $recruiter = new Recruiter();

        if ($userRepository->findBy(['isValidated' => false])) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('recruiter/profil/details.html.twig', [
            'recruiter' => $recruiter,

        ]);
    }


    #[Route('/{id}/edit', name: 'app_recruiter_edit')]
    public function edit(
        Request $request,
        Recruiter $recruiter,
        EntityManagerInterface $manager
    ): Response {


        $form = $this->createForm(RecruiterType::class, $recruiter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();

            $manager->flush();

            $this->addFlash('success', 'Vos information ont bien été mise à jour ! ');


            return $this->redirectToRoute(
                'app_recruiter_details',
                ['id' => 'app.user.recruiter.id'],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('recruiter/profil/edit.html.twig', [
            'recruiter' => $recruiter,
            'recruiterForm' => $form,
        ]);
    }


}
