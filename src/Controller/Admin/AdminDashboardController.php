<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Crud\UserCrudController;
use App\Entity\ApplyValidation;
use App\Entity\Candidate;
use App\Entity\PublishValidation;
use App\Entity\User;
use App\Repository\ApplyValidationRepository;
use App\Repository\PublishValidationRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_CONSULTANT')]
class AdminDashboardController extends AbstractDashboardController
{
    protected AdminUrlGenerator $adminUrlGenerator;
    protected ApplyValidationRepository $applyValidationRepository;
    protected PublishValidationRepository $publishValidationRepository;


    /**
     * @param AdminUrlGenerator $adminUrlGenerator
     * @param ApplyValidationRepository $applyValidationRepository
     * @param PublishValidationRepository $publishValidationRepository
     */
    public function __construct(
        AdminUrlGenerator $adminUrlGenerator,
        ApplyValidationRepository $applyValidationRepository,
        PublishValidationRepository $publishValidationRepository
    ) {
        $this->adminUrlGenerator = $adminUrlGenerator;
        $this->applyValidationRepository = $applyValidationRepository;
        $this->publishValidationRepository = $publishValidationRepository;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CONSULTANT');

        $url = $this->adminUrlGenerator
            ->setController(UserCrudController::class)
            ->generateUrl();

        return $this->redirect($url);


    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Trt Consulting')
            ->generateRelativeUrls('./admin.admin-dashboard.html.twig');
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function configureMenuItems(): iterable
    {
        $numPendingCandidate = $this->applyValidationRepository->getNumPendingCandidate();
        $numPendingAnnounces = $this->publishValidationRepository->getNumPendingAnnounce();

        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateur', 'fa fa-question-circle', User::class);
        yield MenuItem::linkToCrud('Candidats', 'fa fa-question-circle', Candidate::class);
        yield MenuItem::linkToCrud('Validation', 'fa fa-user', ApplyValidation::class)
            ->setBadge($numPendingCandidate, 'warning');
        yield MenuItem::linkToCrud('Validation', 'fa fa-user', PublishValidation::class)
            ->setBadge($numPendingAnnounces, 'warning');


    }
}
