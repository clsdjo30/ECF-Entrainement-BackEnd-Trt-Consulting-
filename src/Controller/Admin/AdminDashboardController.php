<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Crud\CategoryCrudController;
use App\Controller\Admin\Crud\UserCrudController;
use App\Entity\Announce;
use App\Entity\ApplyValidation;
use App\Entity\Candidate;
use App\Entity\Category;
use App\Entity\Consultant;
use App\Entity\User;
use App\Repository\AnnounceRepository;
use App\Repository\ApplyValidationRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin'), isGranted('ROLE_CONSULTANT')]
class AdminDashboardController extends AbstractDashboardController
{
    protected AdminUrlGenerator $adminUrlGenerator;
    protected ApplyValidationRepository $applyValidationRepository;
    protected AnnounceRepository $announceRepository;


    /**
     * @param AdminUrlGenerator $adminUrlGenerator
     * @param ApplyValidationRepository $applyValidationRepository
     * @param AnnounceRepository $announceRepository ;
     */
    public function __construct(
        AdminUrlGenerator $adminUrlGenerator,
        ApplyValidationRepository $applyValidationRepository,
        AnnounceRepository $announceRepository
    ) {
        $this->adminUrlGenerator = $adminUrlGenerator;
        $this->applyValidationRepository = $applyValidationRepository;
        $this->$this->announceRepository = $announceRepository;
    }

    #[Route('/', name: 'admin')]
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
        $numPendingAnnounces = $this->announceRepository->getNumPendingAnnounce();

        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Nouveaux Inscrits');
        yield MenuItem::linkToCrud('A valider', 'fa fa-circle-exclamation', User::class);

        yield MenuItem::section('Candidature à valider');
        yield MenuItem::linkToCrud('A vérifier', 'fa fa-circle-exclamation', ApplyValidation::class)
            ->setBadge($numPendingCandidate, 'warning');

        yield MenuItem::section('Announces à valider');
        yield MenuItem::linkToCrud('A vérifier', 'fa fa-circle-exclamation', Announce::class)
            ->setBadge($numPendingAnnounces, 'warning');

        yield MenuItem::section('Les Annonces');
        yield MenuItem::linkToCrud('Annonces', 'fa-solid fa-pen-to-square', Announce::class);
        yield MenuItem::linkToCrud('Categories', 'fa fa-tags', Category::class)->setController(
            CategoryCrudController::class
        );

        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkToCrud('Consultants', 'fa fa-house-user', Consultant::class);
        yield MenuItem::linkToCrud('Candidats', 'fa fa-utensils', Candidate::class);


    }
}
