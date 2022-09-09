<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\Company;
use App\Entity\Recruiter;
use App\Form\RecruiterType;
use App\Repository\RecruiterRepository;
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
        Address $address,
        Company $company
    ): Response {
        $recruiter = (new Recruiter())
            ->addCompanyId($company);


        return $this->render('recruiter/profil/details.html.twig', [
            'recruiter' => $recruiter,
            'company' => $company,
            'address' => $address,
        ]);
    }

    /**
     *  Display the Recruiter panel administration
     */
    #[Route('/{id}/edit', name: 'app_recruiter_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Recruiter $recruiter,
        Company $company,

        EntityManagerInterface $entityManager
    ): Response {

        $newCompany = new Company();


        $recruiterForm = $this->createForm(RecruiterType::class, $company);
        $recruiterForm->handleRequest($request);

        if ($recruiterForm->isSubmitted() && $recruiterForm->isValid()) {

            $newCompany->setRecruiter($recruiter);
            $newCompany = $recruiterForm->getData();

            $entityManager->persist($newCompany);


            $entityManager->flush();

            $this->addFlash('success', 'Vos information ont bien été mise à jour ! ');


            return $this->redirectToRoute('app_recruiter_details', ['id' => 'app.user.recruiter.id']);
        }


        return $this->render('recruiter/profil/edit.html.twig', [
            'recruiter' => $recruiter,
            'recruiterForm' => $recruiterForm->createView(),
        ]);
    }
}
