<?php

namespace App\Controller;

use App\Entity\Announce;
use App\Form\AnnounceType;
use App\Repository\AnnounceRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/announce')]
class AnnounceController extends AbstractController
{
    #[Route('/', name: 'app_announce', methods: ('GET')), isGranted('ROLE_CANDIDATE')]
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

    #[Route('/new', name: 'app_announce_new', methods: ['GET', 'POST']), isGranted('ROLE_RECRUITER')]
    #[ParamConverter('announce', options: ['id' => 'announce_id'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager,
    ): Response {

        $announce = new Announce();

        $form = $this->createForm(AnnounceType::class, $announce);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $announce = ($form->getData())
                ->setIsValid(false)
                ->setRecruiter($this->getUser()->getRecruiter())
                ->setCreatedat(new DateTime())
                ->setUpdatedAt(new DateTime());


            $manager->persist($announce);
            $manager->flush();

            $this->addFlash(
                'success',
                'Annonce enregistrée ! Un mail vous sera envoyé quand votre annonce sera en ligne !'
            );

            return $this->redirectToRoute(
                'app_recruiter_details',
                ['id' => 'app.user.recruiter.id'],
                Response::HTTP_SEE_OTHER
            );

        }

        return $this->renderForm('announce/create_announce.html.twig', [
            'announce' => $announce,
            'createAnnounceForm' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_announce_details', methods: ['GET', 'POST']), isGranted('ROLE_CANDIDATE')]
    public function showAnnounceDetails(
        Announce $announce,
    ): Response {
        return $this->render('announce/show_announce_details.html.twig', [
            'announce' => $announce,
        ]);
    }

    #[Route('/recruiter/{id}', name: 'app_announce_recruiter', methods: ['GET', 'POST']), isGranted('ROLE_RECRUITER')]
    #[ParamConverter('announce', options: ['id' => 'announce_id'])]
    public function showRecruiterAnnounce(
        AnnounceRepository $announceRepository
    ): Response {
        $announces = $announceRepository->findBy(['recruiter' => $this->getUser()->getRecruiter()]);

        return $this->render('announce/recruiter_announce.html.twig', [
            'announces' => $announces,
        ]);
    }


}
