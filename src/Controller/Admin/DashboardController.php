<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController   
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
        
    }
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(UserCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ecf Symfony');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Local Info');
        
        yield MenuItem::subMenu('User', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create User', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show User', 'fas fa-eye', User::class)
        ]);

        yield MenuItem::subMenu('Article', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Article', 'fas fa-plus', Article::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Article', 'fas fa-eye', Article::class)
        ]);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}